package com.qic.suitecar

import android.Manifest
import android.app.Activity
import android.app.Dialog
import android.bluetooth.BluetoothAdapter
import android.content.ComponentName
import android.content.Context
import android.content.Intent
import android.content.ServiceConnection
import android.content.pm.PackageManager
import android.location.Geocoder
import android.os.Bundle
import android.os.Handler
import android.os.IBinder
import android.os.Message
import android.speech.RecognizerIntent
import android.text.Spannable
import android.text.SpannableStringBuilder
import android.text.style.ForegroundColorSpan
import android.util.Log
import android.view.View
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.drawerlayout.widget.DrawerLayout
import androidx.recyclerview.widget.LinearLayoutManager
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.LatLng
import com.google.gson.Gson
import com.qic.suitecar.dataclass.AirInfoForMap
import com.qic.suitecar.dataclass.ResultData
import com.qic.suitecar.ui.heart.HeartActivity
import com.qic.suitecar.ui.login.LogInActivity
import com.qic.suitecar.ui.login.SharedPreValue
import com.qic.suitecar.ui.sensor.SensorAdaptor
import com.qic.suitecar.dataclass.SensorInfo
import com.qic.suitecar.util.*
import com.qic.suitecar.util.Constants.SensorType
import com.qic.suitecar.util.Map
import com.qic.suitecar.util.bluetooth.BluetoothDevice
import com.qic.suitecar.util.bluetooth.SerialListener
import com.qic.suitecar.util.bluetooth.SerialService
import com.qic.suitecar.util.bluetooth.SerialSocket
import kotlinx.android.synthetic.main.activity_main.*
import kotlinx.android.synthetic.main.dialog_changepassword.*
import kotlinx.android.synthetic.main.dialog_closeaccount.*
import kotlinx.android.synthetic.main.dialog_deregistration.*
import kotlinx.android.synthetic.main.dialog_edituser.*
import kotlinx.android.synthetic.main.item_sensor.view.*
import okhttp3.ResponseBody
import org.json.JSONArray
import org.json.JSONObject
import retrofit2.Call
import retrofit2.Response
import java.text.SimpleDateFormat
import java.util.*
import kotlin.collections.ArrayList

class MainActivity : AppCompatActivity(), ServiceConnection, SerialListener {


    lateinit var suiteManager: SuiteManager
    private val multiplePermissionsCode = 100          //권한
    lateinit var polarSensor: PolarSensor
    //Member object for the chat services
    lateinit var nowDialog: Dialog
    lateinit var map: Map
    private val requiredPermissions = arrayOf(
        Manifest.permission.ACCESS_FINE_LOCATION,
        Manifest.permission.ACCESS_COARSE_LOCATION,
        Manifest.permission.ACCESS_BACKGROUND_LOCATION,
        Manifest.permission.READ_EXTERNAL_STORAGE
    )
    var sensors = ArrayList<SensorInfo>()
    var connected=ArrayList<String>()
    var heartThread = HeartThread()


    private val newline = "\r\n"

    var bluetoothDevices =
        arrayOf(BluetoothDevice(), BluetoothDevice(), BluetoothDevice(), BluetoothDevice())

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        drawerUsernameTextView.text = " " + SharedPreValue.getUsername(this)
        checkPermissions()
        TTS.set(this)
        var smf = supportFragmentManager.findFragmentById(R.id.googleMap) as SupportMapFragment
        map = Map(smf, this)
        drawerLayout.setDrawerLockMode(DrawerLayout.LOCK_MODE_LOCKED_CLOSED)
        suiteManager = SuiteManager(this)
        loadSensors()
        Log.d("welcome", SharedPreValue.getUserNo(this).toString())
        polarSensor = PolarSensor(this, this)
        floatingMenu()
    }

    var goneView: View? = null
    private fun floatingMenu() {
        coFAB.setOnClickListener(mylistener())
        no2FAB.setOnClickListener(mylistener())
        so2FAB.setOnClickListener(mylistener())
        pm25FAB.setOnClickListener(mylistener())
        o3FAB.setOnClickListener(mylistener())
    }

    inner class mylistener : View.OnClickListener {
        override fun onClick(it: View) {
            it.visibility = View.GONE
            var icon: Int
            icon = when (it.id) {
                R.id.coFAB -> R.drawable.ic_co
                R.id.no2FAB -> R.drawable.ic_no2
                R.id.so2FAB -> R.drawable.ic_so2
                R.id.pm25FAB -> R.drawable.ic_pm25
                R.id.o3FAB -> R.drawable.ic_o3
                else -> 0
            }
            searchFloatMenu.menuIconView.setImageDrawable(baseContext.getDrawable(icon))
            searchFloatMenu.close(true)
            if (goneView != null) goneView!!.visibility = View.VISIBLE
            goneView = it
        }
    }

    fun loadSensors() {
        Log.d("LoadSensors","Start")
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)
        val user_no = SharedPreValue.getUserNo(baseContext)
        Runnable {
            myApi.sensorList(Constants.ANDROID, user_no)
                .enqueue(object :
                    retrofit2.Callback<ResponseBody> {
                    override fun onResponse(
                        call: Call<ResponseBody>,
                        response: Response<ResponseBody>
                    ) {
                        sensors = ArrayList()
                        if (response.body() != null) {
                            var a = response.body()!!.string()
                            var gson = Gson()
                            Log.d("sensorList", a+user_no)
                            var jsonObject = JSONObject(a)
                            var jsonArray = jsonObject.getJSONArray("sensors")
                            for (i in 0 until jsonArray.length()) {
                                var jsonObject2 = JSONObject(jsonArray.get(i).toString())
                                Log.d("sensorList", jsonArray.get(i).toString())
                                var sensorInfo=SensorInfo(
                                    jsonObject2.getInt("sensor_no"),
                                    jsonObject2.getString("sname"),
                                    jsonObject2.getString("mac_address"),
                                    SensorType.valueOf(jsonObject2.getString("type")),
                                    false
                                    )
                                Log.d("LoadSensor", sensorInfo.type.toString())
                                sensors.add(sensorInfo)
                            }
                            for(i in connected){
                                Log.d("tlqkf",i)
                                for(sensorInfo in sensors){
                                    if(sensorInfo.mac_address==i){

                                        sensorInfo.status=true
                                    }
                                }
                            }
                        }
                        fitSensors()
                    }

                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                        Log.d("Close Account", t.message)
                    }
                })
        }.run()
    }

    fun fitSensors() {
        sensors.add(SensorInfo(0, "뿌앵", "뿌애앵", SensorType.ADDSENSOR,false))
        drawerSensorRecyclerView.removeAllViews()
        drawerSensorRecyclerView.adapter = SensorAdaptor(this, this, sensors)
        drawerSensorRecyclerView.layoutManager = LinearLayoutManager(this)

    }

    fun onClick(view: View) {
        when (view.id) {
            R.id.openDrawerButton -> {
                drawerLayout.openDrawer(drawer)
            }
            R.id.drawerLogOutTextView -> {
                //TODO:Send to server for signout
                SharedPreValue.setLoginFlag(this, false)
                SharedPreValue.setUsername(this, "")
                SharedPreValue.setUserNo(this, 0)
                var intent = Intent(this, LogInActivity::class.java)
                startActivity(intent)
            }
            R.id.suiteButton -> {
                //sendMessage("start")
                //suiteManager.suite()
                send("0", SensorType.CAR)
//                polarSensor.connect()

            }
            R.id.drawerEditUserButton -> {
                showEditUserButton()
            }
            R.id.realtimeHeartLayout -> {
                var intent = Intent(this, HeartActivity::class.java)
                startActivity(intent)
            }
            R.id.sensorInfoRefreshButton -> {
                loadSensors()
            }
            R.id.searchButton -> {
                var geocoder = Geocoder(this)
                var addressList = geocoder.getFromLocationName(
                    searchEditText.text.toString(), // 주소
                    10
                ) // 최대 검색 결과 개수
                if (addressList.size == 0) {
                    Toast.makeText(this, "Can't find location", Toast.LENGTH_SHORT).show()
                } else {
                    searchEditText.setText(addressList[0].getAddressLine(0))
                    map.viewLocation(LatLng(addressList[0].latitude, addressList[0].longitude))
                    map.refreshMarker()
                }
            }
            R.id.myLocationFAB -> {
                map.viewLocation(map.cur_loc)
            }
              R.id.testbutton -> {
                  send("start", SensorType.INAIRSENSOR)
              }
            /*  R.id.testbutton1 -> {
                  send("start", SensorType.OutAirSensor)
              }
              R.id.testbutton2->{
                  reloadMap()
              }*/
            /*R.id.heartImageView->{
                var intent = Intent(this,HeartActivity::class.java)
                startActivity(intent)
            }*/
        }
    }

    private fun reloadMap() {
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)
        Runnable {
            myApi.db_data_for_map()
                .enqueue(object : retrofit2.Callback<ResponseBody> {
                    override fun onResponse(
                        call: Call<ResponseBody>,
                        response: Response<ResponseBody>
                    ) {
                        var a = response.body()!!.string()
                        Log.d("db_data_for_map", a)
                        var gson = Gson()
                        var jsonArray = JSONArray(a)
                        var airInfoforMap = ArrayList<AirInfoForMap>()
                        for (i in 0 until jsonArray.length()) {
                            airInfoforMap.add(
                                gson.fromJson(
                                    jsonArray[i].toString(),
                                    AirInfoForMap::class.java
                                )
                            )
                        }
                        map.airInfoForMaps = airInfoforMap
                        map.refreshMarker()
                    }

                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                        Log.d("db_data_for_map", t.message)
                    }
                })
        }.run()
        //json 분해

    }

    fun showRemoveSensorDialog(sensorInfo: SensorInfo) {
        var dialog = Dialog(this)
        dialog.setContentView(R.layout.dialog_deregistration)
        dialog.setCancelable(true)
        dialog.removeSensorId.text = sensorInfo.sname
        dialog.removeSensorMac.text = sensorInfo.mac_address
        dialog.removeSensorType.text = sensorInfo.type.toString()
        val user_no = SharedPreValue.getUserNo(baseContext)
        dialog.show()
        dialog.removeDialogRemoveButton.setOnClickListener {
            Log.d("Remove Sensor", "Remove")
            var retrofit = RetrofitClient.getInstnace()
            var myApi = retrofit.create(IServer::class.java)

            Runnable {
                myApi.sensorDeRegistration(1, user_no, sensorInfo.sensor_no)
                    .enqueue(object :
                        retrofit2.Callback<ResponseBody> {
                        override fun onResponse(
                            call: Call<ResponseBody>,
                            response: Response<ResponseBody>
                        ) {
                            var a = response.body()!!.string()
                            var gson = Gson()
                            Log.d("sensor DeRegistration", a)
                            loadSensors()

//                            var jsonObject = JSONObject(a)
//                            val sensor_no=jsonObject.getInt("sensor_no")

                            /*      sensors[type] = (SensorInfo(sensor_no, sensorName, sensorMac, sensorType))
                                  drawerSensorRecyclerView.adapter!!.notifyDataSetChanged()
                                  drawerSensorRecyclerView[type].addSensorLayout.visibility = View.GONE
                                  drawerSensorRecyclerView[type].itemSensorLayout.visibility = View.VISIBLE
                                  connectDevice(sensorMac, true)*/
                            dialog.dismiss()
                        }

                        override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                            Log.d("Sensor Deregistration", t.message)
                        }
                    })
            }.run()

            dialog.dismiss()
        }
        dialog.removeDialogCancelButton.setOnClickListener {
            Log.d("Remove Sensor", "Cancel")
            dialog.dismiss()
        }
    }

    private fun showEditUserButton() {
        var dialog = Dialog(this)
        dialog.setContentView(R.layout.dialog_edituser)
        dialog.setCancelable(true)
        dialog.show()
        dialog.editUserDialogChangePasswordButton.setOnClickListener {
            showChangePasswordDiagram()
            dialog.dismiss()
        }
        dialog.editUserDialogCloseAccountButton.setOnClickListener {
            showCloseAccountDiagram()
            dialog.dismiss()
        }
        dialog.editUserDialogCancelButton.setOnClickListener {
            Log.d("Edit User", "Cancel")
            dialog.dismiss()
        }
    }


    private fun showCloseAccountDiagram() {
        var dialog = Dialog(this)
        dialog.setContentView(R.layout.dialog_closeaccount)
        dialog.setCancelable(true)
        dialog.show()
        dialog.closeAccountSubmitButton.setOnClickListener {
            var retrofit = RetrofitClient.getInstnace()
            var myApi = retrofit.create(IServer::class.java)
            val user_no = SharedPreValue.getUserNo(baseContext)
            val password = dialog.closeAccountPassword.text.toString()
            Runnable {
                myApi.closeAccount(1, user_no, password)
                    .enqueue(object :
                        retrofit2.Callback<ResponseBody> {
                        override fun onResponse(
                            call: Call<ResponseBody>,
                            response: Response<ResponseBody>
                        ) {
                            var a = response.body()!!.string()
                            var gson = Gson()
                            Log.d("Change Password", a)
                            var resultData = gson.fromJson(a, ResultData::class.java)
                            when (resultData.result) {
                                0 -> {
                                    Toast.makeText(
                                        baseContext,
                                        "I Won't let you go!!!!",
                                        Toast.LENGTH_SHORT
                                    ).show()
                                }
                                1 -> {
                                    Toast.makeText(
                                        baseContext,
                                        "Success to Close Account... Bye...",
                                        Toast.LENGTH_SHORT
                                    ).show()
                                    var intent = Intent(baseContext, LogInActivity::class.java)
                                    startActivity(intent)
                                }
                            }
                            dialog.dismiss()

                        }

                        override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                            Log.d("Close Account", t.message)
                        }
                    })
            }.run()
            dialog.closeAccountCancelButton.setOnClickListener {
                Log.d("Change Password", "Cancel")
                dialog.dismiss()
            }
        }
    }

    override fun onStart() {
        super.onStart()
        for (i in 1..3) {
            if (bluetoothDevices[i].service != null)
                bluetoothDevices[i].service!!.attach(this)
        }
        startService(
            Intent(
                this,
                SerialService::class.java
            )
        ) // prevents service destroy on unbind from recreated activity caused by orientation change
        this.bindService(
            Intent(this, SerialService::class.java),
            this,
            Context.BIND_AUTO_CREATE
        )

    }

    override fun onDestroy() {
        super.onDestroy()
        polarSensor.api.shutDown()
        for (i in 1..3) {
            if (bluetoothDevices[i].connected != Constants.Connected.False)
                disconnect(SensorType.values()[i])
        }
        stopService(Intent(this, SerialService::class.java))
    }

    public override fun onStop() {
        for (i in 1..3) {
            if (bluetoothDevices[i].service != null && !this.isChangingConfigurations)
                bluetoothDevices[i].service!!.detach()
        }
        super.onStop()
    }

    override fun onPause() {
        super.onPause()
        polarSensor.api.backgroundEntered()
    }

    override fun onResume() {
        super.onResume()
        polarSensor.api.foregroundEntered()
        for (i in 1..3) {
            if (bluetoothDevices[i].initialStart && bluetoothDevices[i].service != null) {
                bluetoothDevices[i].initialStart = false
                this.runOnUiThread { this.connect(SensorType.values()[i]) }
            }
        }
    }


    private fun showChangePasswordDiagram() {
        var dialog = Dialog(this)
        dialog.setContentView(R.layout.dialog_changepassword)
        dialog.setCancelable(true)
        dialog.show()
        dialog.changeDialogChangeButton.setOnClickListener {
            var retrofit = RetrofitClient.getInstnace()
            var myApi = retrofit.create(IServer::class.java)
            val originalPassword = dialog.originalPasswordEditText.text.toString()
            val newPassword = dialog.newPasswordEditText.text.toString()
            val confirmPassword = dialog.passwordConfirmEditText.text.toString()
            val user_no = SharedPreValue.getUserNo(this)
            Log.d("Change", originalPassword + newPassword + confirmPassword)
            if (newPassword == confirmPassword) {
                Runnable {
                    myApi.changePassword(
                        1,
                        user_no,
                        originalPassword,
                        newPassword,
                        confirmPassword
                    )
                        .enqueue(object :
                            retrofit2.Callback<ResponseBody> {
                            override fun onResponse(
                                call: Call<ResponseBody>,
                                response: Response<ResponseBody>
                            ) {
                                var a = response.body()!!.string()
                                var gson = Gson()
                                Log.d("Change Password", a)
                                var resultData = gson.fromJson(a, ResultData::class.java)
                                when (resultData.result) {
                                    0 -> {
                                        Toast.makeText(
                                            baseContext,
                                            "Check you original password",
                                            Toast.LENGTH_SHORT
                                        ).show()
                                    }
                                    1 -> {
                                        Toast.makeText(
                                            baseContext,
                                            "Success to change the Password",
                                            Toast.LENGTH_SHORT
                                        ).show()
                                        SharedPreValue.setLoginFlag(baseContext, false)
                                        var intent =
                                            Intent(baseContext, LogInActivity::class.java)
                                        startActivity(intent)
                                    }
                                }
                            }

                            override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                                Log.d("SignIn", "Fail : " + t.message)
                            }
                        })
                }.run()
                dialog.dismiss()
            } else {
                Toast.makeText(
                    baseContext,
                    "The new and confirm password are not same",
                    Toast.LENGTH_SHORT
                ).show()
            }

        }
        dialog.changeDialogCancelButton.setOnClickListener {
            Log.d("Change Password", "Cancel")
            dialog.dismiss()
        }

    }


    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        when (requestCode) {

            Constants.ADD_SENSOR_REQ -> {
                Log.d("Add sensor result", resultCode.toString())
                if (resultCode == Constants.OKAY) {
                    loadSensors()
                } else if (resultCode == Constants.CANCEL) {

                }
            }
            Constants.SPEECH_INPUT_REQ -> {
                if (resultCode == Activity.RESULT_OK && null != data) {
                    val result = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS)
                    suiteManager.command(result[0])

                    Toast.makeText(this, result!![0], Toast.LENGTH_LONG).show()
                }
            }
            else -> {
                // User did not enable Bluetooth or an error occurred
                Toast.makeText(
                    this, "asddas",
                    Toast.LENGTH_SHORT
                ).show()
                //this.finish()
            }
        }
    }

    private fun checkPermissions() {
        var rejectedPermissionList = ArrayList<String>()
        //필요한 퍼미션들을 하나씩 끄집어내서 현재 권한을 받았는지 체크
        for (permission in requiredPermissions) {
            if (ContextCompat.checkSelfPermission(
                    this,
                    permission
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                //만약 권한이 없다면 rejectedPermissionList에 추가
                rejectedPermissionList.add(permission)
            }
        }
        //거절된 퍼미션이 있다면...
        if (rejectedPermissionList.isNotEmpty()) {
            //권한 요청!
            val array = arrayOfNulls<String>(rejectedPermissionList.size)
            ActivityCompat.requestPermissions(
                this,
                rejectedPermissionList.toArray(array),
                multiplePermissionsCode
            )
        }
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String>,
        grantResults: IntArray
    ) {
        when (requestCode) {
            multiplePermissionsCode -> {
                if (grantResults.isNotEmpty()) {
                    for ((i, permission) in permissions.withIndex()) {
                        if (grantResults[i] != PackageManager.PERMISSION_GRANTED) {
                            //권한 획득 실패
                        }
                    }
                }
            }
        }
    }

    var handler = object : Handler() {
        override fun handleMessage(msg: Message) {
            when (msg.what) {
                0 -> {

                    if (PolarData.heartDatas.isEmpty()) {
                        realtimeNotConnect.visibility = View.VISIBLE
                        realtimeHeartLayout.visibility = View.GONE
                    } else {
                        realtimeNotConnect.visibility = View.GONE
                        realtimeHeartLayout.visibility = View.VISIBLE
                        realtimeHRTextView.text = PolarData.heartDatas.last().heart.toString()

                    }
                }
                1 -> {
                    Log.d("Message", msg.arg1.toString())
                }
            }
        }
    }

    fun polarDataTransfer() {
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)
        val user_no = SharedPreValue.getUserNo(baseContext)
        var dt = Date()
        var sdf = SimpleDateFormat("yyyy-MM-dd hh:mm:ss")
        Log.d("DATE", sdf.format(dt).toString())

        if (PolarData.heartDatas.size > 0) {
            myApi.polarDataTransfer(
                Constants.ANDROID,
                polarSensor.sensor_no,
                user_no,
                sdf.format(dt).toString(),
                PolarData.heartDatas.last().heart,
                PolarData.heartDatas.last().rr_interval,
                map.cur_loc.latitude.toFloat(),
                map.cur_loc.longitude.toFloat()
            )
                .enqueue(object :
                    retrofit2.Callback<ResponseBody> {
                    override fun onResponse(
                        call: Call<ResponseBody>,
                        response: Response<ResponseBody>
                    ) {
                        if (response.body() != null) {
                            var a = response.body()!!.string()
                            var gson = Gson()
                            Log.d("polarDataTransfer", a)
                        }
                    }

                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                        Log.d("Close Account", t.message)
                    }
                })
        }
    }

    var polar_flag = true

    inner class HeartThread : Thread() {
        override fun run() {
            while (polar_flag) {
                sleep(1000)
                polarDataTransfer()
                handler.sendEmptyMessage(0)
                Log.d("transfer Thread", polar_flag.toString())
            }
            handler.sendEmptyMessage(0)
        }
    }

    override fun onServiceConnected(name: ComponentName, binder: IBinder) {
        for (i in 1..3) {
            bluetoothDevices[i].service = (binder as SerialService.SerialBinder).service
            bluetoothDevices[i].initialStart = false
            //   this.runOnUiThread { this.connect(SensorType.values()[i])}
        }
    }

    override fun onServiceDisconnected(name: ComponentName) {
        for (i in 1..3) {
            bluetoothDevices[i].service = null
        }
    }

    fun connect(type: SensorType) {
        try {
            Log.w(this.javaClass.name, "connect()")
            val bluetoothAdapter = BluetoothAdapter.getDefaultAdapter()
            val device =
                bluetoothAdapter.getRemoteDevice(bluetoothDevices[type.ordinal].deviceAddress)
            val deviceName = if (device.name != null) device.name else device.address
            status("1 connecting...1")
            bluetoothDevices[type.ordinal].connected = Constants.Connected.Pending
            status("1 connecting...2")
            bluetoothDevices[type.ordinal].socket = SerialSocket()
            status("1 connecting...3")
            bluetoothDevices[type.ordinal].service!!.connect(this, "Connected to $deviceName")
            status("1 connecting...4")
            bluetoothDevices[type.ordinal].socket!!.connect(
                this,
                bluetoothDevices[type.ordinal].service!!,
                device
            )
            status("1 connecting...5")
        } catch (e: Exception) {
            onSerialConnectError(e)
        }

    }

    fun disconnect(type: SensorType) {
        bluetoothDevices[type.ordinal].connected = Constants.Connected.False
        if (bluetoothDevices[type.ordinal].service != null)
            bluetoothDevices[type.ordinal].service!!.disconnect()
        if (bluetoothDevices[type.ordinal].socket != null)
            bluetoothDevices[type.ordinal].socket!!.disconnect()
        bluetoothDevices[type.ordinal].socket = null
    }

    private fun send(str: String, type: SensorType) {
        Log.w(this.javaClass.name, "send()")
        /* if (connected != Connected.True) {
             Toast.makeText(this, "not connected", Toast.LENGTH_SHORT).show()
             return
         }*/
        try {
            val spn = SpannableStringBuilder(str + '\n')
            spn.setSpan(
                ForegroundColorSpan(resources.getColor(R.color.colorSendText)),
                0,
                spn.length,
                Spannable.SPAN_EXCLUSIVE_EXCLUSIVE
            )
            //  receiveText.append(spn);
            val data = (str + newline).toByteArray()
            bluetoothDevices[type.ordinal].socket!!.write(data)
        } catch (e: Exception) {
            onSerialIoError(e)
        }

    }

    private fun receive(data: ByteArray) {
        Log.w(this.javaClass.name, String(data))
        val strs = String(data).split(",").toTypedArray()
        strs[1] = strs[1].substring(1)
        val airData = ArrayList<Double>()
        for (i in 0..strs.size - 2) {
            airData.add(strs[i + 1].toDouble())
        }
        var sensor_no: Int = 0
        for (i in sensors) {
            if (i.mac_address == strs[0]) {
                sensor_no = i.sensor_no
            }
        }
        //데이터 변환 및 aqi 계산

        var dt = Date()
        var sdf = SimpleDateFormat("yyyy-MM-dd hh:mm:ss")
        sdf.format(dt).toString()
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)
        Runnable {
            myApi.udooDataTransfer(
                Constants.ANDROID, sensor_no, sdf.format(dt).toString(), airData[1],
                airData[2], airData[3], airData[4], airData[5], airData[6],
                airData[2], airData[3], airData[4], airData[5], airData[6],
                map.cur_loc.latitude.toFloat(), map.cur_loc.longitude.toFloat()
            )
                .enqueue(object :
                    retrofit2.Callback<ResponseBody> {
                    override fun onResponse(
                        call: Call<ResponseBody>,
                        response: Response<ResponseBody>
                    ) {
                        var a = response.body()!!.string()
                        var gson = Gson()
                        Log.d("udooDataTransfer", a)
                    }

                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                        Log.d("udooDataTransfer", t.message)
                    }
                })
        }.run()

    }

    private fun status(str: String) {
        Log.d("status", str)
        val spn = SpannableStringBuilder(str + '\n')
        spn.setSpan(
            ForegroundColorSpan(resources.getColor(R.color.colorStatusText)),
            0,
            spn.length,
            Spannable.SPAN_EXCLUSIVE_EXCLUSIVE
        )
        //receiveText.append(spn);
    }

    /*
     * SerialListener
     */
    override fun onSerialConnect() {
        status("connected")
    }


    override fun onSerialRead(data: ByteArray) {
        receive(data)
    }

    override fun onSerialIoError(e: Exception) {
        status("connection lost: " + e.message)
        /*for(i in SensorType.values()) {
            disconnect(i)
        }*/
    }

    override fun onSerialConnectError(e: Exception?) {
        status("connection failed: " + e!!.message)
        /*for(i in SensorType.values()) {
            disconnect(i)
        }*/
    }
}
