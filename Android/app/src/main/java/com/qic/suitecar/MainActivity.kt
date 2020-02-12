package com.qic.suitecar

import android.Manifest
import android.app.Activity
import android.app.Dialog
import android.bluetooth.BluetoothAdapter
import android.content.Context
import android.content.Intent
import android.content.pm.PackageManager
import android.opengl.Visibility
import android.os.Bundle
import android.os.Handler
import android.os.Message
import android.speech.RecognizerIntent
import android.util.Log
import android.view.ActionMode
import android.view.View
import android.widget.ArrayAdapter
import android.widget.TextView
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.core.view.get
import androidx.drawerlayout.widget.DrawerLayout
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.google.android.gms.maps.SupportMapFragment
import com.google.gson.Gson
import com.qic.suitecar.dataclass.ResultData
import com.qic.suitecar.ui.login.LogInActivity
import com.qic.suitecar.ui.login.SharedPreValue
import com.qic.suitecar.ui.sensor.SensorAdaptor
import com.qic.suitecar.ui.sensor.SensorInfo
import com.qic.suitecar.util.*
import com.qic.suitecar.util.Map
import kotlinx.android.synthetic.main.activity_main.*
import kotlinx.android.synthetic.main.dialog_addsensor.*
import kotlinx.android.synthetic.main.dialog_addsensor.addSensorDialogCancelButton
import kotlinx.android.synthetic.main.dialog_changepassword.*
import kotlinx.android.synthetic.main.dialog_closeaccount.*
import kotlinx.android.synthetic.main.dialog_edituser.*
import kotlinx.android.synthetic.main.fragment_setting.view.*
import kotlinx.android.synthetic.main.item_sensor.*
import kotlinx.android.synthetic.main.item_sensor.view.*
import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.Response

class MainActivity : AppCompatActivity() {
    val REQ_CODE_SPEECH_INPUT = 0
    lateinit var suiteManager: SuiteManager
    private val multiplePermissionsCode = 100          //권한

    // Intent request codes
    private val REQUEST_CONNECT_DEVICE_SECURE = 1
    private val REQUEST_CONNECT_DEVICE_INSECURE = 2
    private val REQUEST_ENABLE_BT = 3

    //Name of the connected device
    private var mConnectedDeviceName: String? = null
    //Array adapter for the conversation thread
    private var mConversationArrayAdapter: ArrayAdapter<String>? = null
    //String buffer for outgoing messages
    private var mOutStringBuffer: StringBuffer? = null
    //Local Bluetooth adapter
    private var mBluetoothAdapter: BluetoothAdapter? = null
    //Member object for the chat services
    lateinit var nowDialog:Dialog

    private val requiredPermissions = arrayOf(
        Manifest.permission.ACCESS_FINE_LOCATION,
        Manifest.permission.ACCESS_COARSE_LOCATION,
        Manifest.permission.ACCESS_BACKGROUND_LOCATION,
        Manifest.permission.READ_EXTERNAL_STORAGE
    )
    var sensors = ArrayList<SensorInfo>()
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        drawerUsernameTextView.text = " " + SharedPreValue.getUsername(this)
        checkPermissions()
        TTS.set(this)
        var smf = supportFragmentManager.findFragmentById(R.id.googleMap) as SupportMapFragment
        var map = Map(smf, this)
        drawerLayout.setDrawerLockMode(DrawerLayout.LOCK_MODE_LOCKED_CLOSED)
        suiteManager = SuiteManager(this)
        loadSensors()
        Log.d("welcome", SharedPreValue.getUserNo(this).toString())

        // Get local Bluetooth adapter
        mBluetoothAdapter = BluetoothAdapter.getDefaultAdapter()
        // If the adapter is null, then Bluetooth is not supported
        if (mBluetoothAdapter == null) {
            Toast.makeText(this, "Bluetooth is not available", Toast.LENGTH_LONG).show()
           // this.finish()
        }

    }


    private fun loadSensors() {
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
                        var a = response.body()!!.string()
                        var gson = Gson()
                        Log.d("sensorList", a)
                       /* var resultData = gson.fromJson(a, ResultData::class.java)
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
                        }*/
                        setSensors()
                    }

                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                        Log.d("Close Account", t.message)
                    }
                })
        }.run()
    }
    fun setSensors(){
        sensors.add(SensorInfo(0, "뿌앵", "뿌애앵", -1))
        sensors.add(SensorInfo(0, "뿌앵", "뿌애앵", -2))
        sensors.add(SensorInfo(0, "뿌앵", "뿌애앵", -3))
        drawerSensorRecyclerView.adapter = SensorAdaptor(this, this,sensors)
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
                sendMessage("hihihi")
                //suiteManager.suite()
            }
            R.id.drawerAddSensorButton -> {

            }
            R.id.drawerEditUserButton -> {
                showEditUserButton()
            }
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

    fun showAddSensorDiagram(type:Int) {
        var dialog = Dialog(this)
        nowDialog=dialog
        dialog.setContentView(R.layout.dialog_addsensor)
        dialog.setCancelable(true)
        dialog.show()
        dialog.addSensorScanButton.setOnClickListener {
            val intent = Intent(this, DeviceListActivity::class.java)
            startActivityForResult(intent, REQUEST_CONNECT_DEVICE_SECURE)
        }
        dialog.addSensorDialogAddButton.setOnClickListener {
            val sensorId = dialog.addSensorId.text.toString()
            val sensorMac = dialog.addSensorMac.text.toString()
            val sensorType = type
            sensors[type]=(SensorInfo(R.drawable.ic_outair, sensorId, sensorMac, sensorType))
            drawerSensorRecyclerView.adapter!!.notifyDataSetChanged()
            drawerSensorRecyclerView[type].addSensorLayout.visibility=View.GONE
            drawerSensorRecyclerView[type].itemSensorLayout.visibility=View.VISIBLE
            connectDevice(sensorMac, true)
            dialog.dismiss()
        }
        dialog.addSensorDialogCancelButton.setOnClickListener {
            Log.d("Add Sensor", "Cancel")
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
        if (!mBluetoothAdapter!!.isEnabled) {
            val enableIntent = Intent(BluetoothAdapter.ACTION_REQUEST_ENABLE)
            startActivityForResult(enableIntent, REQUEST_ENABLE_BT)
            // Otherwise, setup the chat session
        } else if (BluetoothManager.BService == null) {
            setupChat()
        }
    }

    override fun onDestroy() {
        super.onDestroy()
        if(BluetoothManager.BService!=null) {
            BluetoothManager.BService!!.stop()
        }

    }

    override fun onResume() {
        super.onResume()
        // Performing this check in onResume() covers the case in which BT was
        // not enabled during onStart(), so we were paused to enable it...
        // onResume() will be called when ACTION_REQUEST_ENABLE activity returns.
         if (BluetoothManager.BService != null) {
             // Only if the state is STATE_NONE, do we know that we haven't started already
             if (BluetoothManager.BService!!.getState() === Constants.STATE_NONE) {
                 // Start the Bluetooth chat services
                 BluetoothManager.BService!!.start()
             }
         }
    }

    /**
     * Set up the UI and background operations for chat.
     */
    private fun setupChat() {
        // Initialize the BluetoothChatService to perform bluetooth connections
        BluetoothManager.BService = BluetoothService(this, mHandler)
        // Initialize the buffer for outgoing messages
        mOutStringBuffer = StringBuffer("")
    }

    /**
     * Makes this device discoverable for 300 seconds (5 minutes).
     */
    private fun ensureDiscoverable() {
        if (mBluetoothAdapter!!.scanMode != BluetoothAdapter.SCAN_MODE_CONNECTABLE_DISCOVERABLE) {
            val discoverableIntent = Intent(BluetoothAdapter.ACTION_REQUEST_DISCOVERABLE)
            discoverableIntent.putExtra(BluetoothAdapter.EXTRA_DISCOVERABLE_DURATION, 300)
            startActivity(discoverableIntent)
        }
    }

    /**
     * Sends a message.
     *
     * @param message A string of text to send.
     */
    private fun sendMessage( message: String) {
        // Check that we're actually connected before trying anything
        if (BluetoothManager.BService!!.getState() !== Constants.STATE_CONNECTED) {
            Toast.makeText(this, "NOP", Toast.LENGTH_SHORT).show()
            return
        }
        // Check that there's actually something to send
        if (message.isNotEmpty()) {
            // Get the message bytes and tell the BluetoothChatService to write
            val send = message.toByteArray()
            BluetoothManager.BService!!.write(send)
            // Reset out string buffer to zero and clear the edit text field
            mOutStringBuffer!!.setLength(0)
            Log.d("BLUE", mOutStringBuffer.toString())
        }
    }

    private val mHandler = object : Handler() {
        override fun handleMessage(msg: Message) {
            val activity = this
            when (msg.what) {
                Constants.MESSAGE_STATE_CHANGE ->
                    when (msg.arg1) {
                        Constants.STATE_CONNECTED -> {
                            //setStatus(getString(R.string.title_connected_to, mConnectedDeviceName))
                            //  mConversationArrayAdapter!!.clear()
                        }
                        Constants.STATE_CONNECTING -> {
                        }//setStatus(R.string.title_connecting)
                        Constants.STATE_LISTEN, Constants.STATE_NONE -> {
                        } //setStatus(R.string.title_not_connected)
                    }
                Constants.MESSAGE_WRITE -> {
                    val writeBuf = msg.obj as ByteArray
                    // construct a string from the buffer
                    val writeMessage = String(writeBuf)
                    // mConversationArrayAdapter!!.add("Me:  $writeMessage")
                   logTextView.text= logTextView.text.toString() + "Me : $writeMessage"+"\n"
                }
                Constants.MESSAGE_READ -> {
                    val readBuf = msg.obj as ByteArray
                    // construct a string from the valid bytes in the buffer
                    val readMessage = String(readBuf, 0, msg.arg1)
                    // mConversationArrayAdapter!!.add("$mConnectedDeviceName:  $readMessage")
                    logTextView.text= logTextView.text.toString() + "$mConnectedDeviceName : $readMessage"+"\n"
                }
                Constants.MESSAGE_DEVICE_NAME -> {
                    // save the connected device's name
                    mConnectedDeviceName = msg.data.getString(Constants.DEVICE_NAME)
                    if (null != activity) {
                        Toast.makeText(
                            baseContext,
                            "Connected to $mConnectedDeviceName",
                            Toast.LENGTH_SHORT
                        ).show()
                    }
                }
                Constants.MESSAGE_TOAST -> if (null != activity) {
                    Toast.makeText(
                        baseContext, msg.data.getString(Constants.TOAST),
                        Toast.LENGTH_SHORT
                    ).show()
                }
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
                    myApi.changePassword(1, user_no, originalPassword, newPassword, confirmPassword)
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
                                        var intent = Intent(baseContext, LogInActivity::class.java)
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

    /**
     * Establish connection with other device
     *
     * @param data   An [Intent] with [DeviceListActivity.EXTRA_DEVICE_ADDRESS] extra.
     * @param secure Socket Security type - Secure (true) , Insecure (false)
     */
    private fun connectDevice(address: String, secure: Boolean) {
        // Get the device MAC address
        Log.d("Bluetooth", address)
        // Get the BluetoothDevice object
        val device = mBluetoothAdapter!!.getRemoteDevice(address)
        // Attempt to connect to the device
        BluetoothManager.BService!!.connect(device, secure)
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        when (requestCode) {
            REQ_CODE_SPEECH_INPUT -> {
                if (resultCode == Activity.RESULT_OK && null != data) {
                    val result = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS)
                    suiteManager.command(result[0])

                    Toast.makeText(this, result!![0], Toast.LENGTH_LONG).show()
                }
            }
            REQUEST_CONNECT_DEVICE_SECURE -> // When DeviceListActivity returns with a device to connect
            {
                if (resultCode == Activity.RESULT_OK) {
                    val address = data!!.extras!!.getString("device_address")
                    nowDialog.addSensorMac.text=address
                    //connectDevice(address!!, true)
                }
            }
            REQUEST_CONNECT_DEVICE_INSECURE -> {
                // When DeviceListActivity returns with a device to connect
                if (resultCode == Activity.RESULT_OK) {
                    val address = data!!.extras!!.getString("device_address")
                    nowDialog.addSensorMac.text=address
                    //connectDevice(address!!, false)
                }
            }
            REQUEST_ENABLE_BT -> {
                // When the request to enable Bluetooth returns
                if (resultCode == Activity.RESULT_OK) {
                    // Bluetooth is now enabled, so set up a chat session
                    setupChat()
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

}
