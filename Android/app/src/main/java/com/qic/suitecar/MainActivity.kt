package com.qic.suitecar

import android.Manifest
import android.app.Activity
import android.app.Dialog
import android.content.Intent
import android.content.pm.PackageManager
import android.os.Bundle
import android.speech.RecognizerIntent
import android.util.Log
import android.view.View
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.drawerlayout.widget.DrawerLayout
import androidx.recyclerview.widget.LinearLayoutManager
import com.google.android.gms.maps.SupportMapFragment
import com.google.gson.Gson
import com.qic.suitecar.dataclass.ResultData
import com.qic.suitecar.ui.login.LogInActivity
import com.qic.suitecar.ui.login.SharedPreValue
import com.qic.suitecar.ui.sensor.SensorAdaptor
import com.qic.suitecar.ui.sensor.SensorInfo
import com.qic.suitecar.util.IServer
import com.qic.suitecar.util.Map
import com.qic.suitecar.util.RetrofitClient
import com.qic.suitecar.util.TTS
import kotlinx.android.synthetic.main.activity_main.*
import kotlinx.android.synthetic.main.dialog_addsensor.*
import kotlinx.android.synthetic.main.dialog_addsensor.addSensorDialogCancelButton
import kotlinx.android.synthetic.main.dialog_changepassword.*
import kotlinx.android.synthetic.main.dialog_edituser.*
import kotlinx.android.synthetic.main.fragment_setting.view.*
import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.Response

class MainActivity : AppCompatActivity() {
    val REQ_CODE_SPEECH_INPUT = 0
    lateinit var suiteManager: SuiteManager
    private val multiplePermissionsCode = 100          //권한
    private val requiredPermissions = arrayOf(
        Manifest.permission.ACCESS_FINE_LOCATION,
        Manifest.permission.ACCESS_COARSE_LOCATION,
        Manifest.permission.ACCESS_BACKGROUND_LOCATION,
        Manifest.permission.READ_EXTERNAL_STORAGE
    )
    var sensors=ArrayList<SensorInfo>()
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        drawerUsernameTextView.text=" "+SharedPreValue.getUsername(this)
        checkPermissions()
        TTS.set(this)
        var smf = supportFragmentManager.findFragmentById(R.id.googleMap) as SupportMapFragment
        var map = Map(smf, this)
        drawerLayout.setDrawerLockMode(DrawerLayout.LOCK_MODE_LOCKED_CLOSED)
        suiteManager = SuiteManager(this)
        setSensors()
    }

    private fun setSensors() {

        sensors.add(SensorInfo(R.drawable.ic_heartsensor,"뿌앵","뿌애앵","뿌애애애앵"))
        sensors.add(SensorInfo(R.drawable.ic_inair,"뿌앵","뿌애앵","뿌애애애앵"))
        sensors.add(SensorInfo(R.drawable.ic_outair,"뿌앵","뿌애앵","뿌애애애앵"))
        drawerSensorRecyclerView.adapter= SensorAdaptor(this,sensors)
        drawerSensorRecyclerView.layoutManager= LinearLayoutManager(this)
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
                suiteManager.suite()
            }
            R.id.drawerAddSensorButton->{
                showAddSensorDiagram()
            }
            R.id.drawerEditUserButton->{
                showEditUserButton()
            }
        }
    }
    private fun showEditUserButton() {
        var dialog = Dialog(this)
        dialog.setContentView(R.layout.dialog_edituser)
        dialog.setCancelable(true)
        dialog.show()
        dialog.editUserDialogChangePasswordButton.setOnClickListener{
            showChangePasswordDiagram()
            dialog.dismiss()
        }
        dialog.editUserDialogCloseAccountButton.setOnClickListener{
            Log.d("Edit User", "close account")
            dialog.dismiss()
        }
        dialog.editUserDialogCancelButton.setOnClickListener{
            Log.d("Edit User", "Cancel")
            dialog.dismiss()
        }
    }
    private fun showAddSensorDiagram() {
        var dialog = Dialog(this)
        dialog.setContentView(R.layout.dialog_addsensor)
        dialog.setCancelable(true)
        dialog.show()
        dialog.addSensorDialogAddButton.setOnClickListener{
            val sensorId=dialog.addSensorId.text.toString()
            val sensorMac=dialog.addSensorMac.text.toString()
            val sensorType=dialog.addSensorType.text.toString()
            sensors.add(SensorInfo(R.drawable.logo,sensorId,sensorMac,sensorType))
            drawerSensorRecyclerView.adapter!!.notifyDataSetChanged()
            dialog.dismiss()
        }
        dialog.addSensorDialogCancelButton.setOnClickListener{
            Log.d("Add Sensor", "Cancel")
            dialog.dismiss()
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
            val user_no=SharedPreValue.getUserNo(this)
            Log.d("Change", originalPassword + newPassword + confirmPassword)
            if (newPassword == confirmPassword) {
                Runnable {
                    myApi.changePassword(1, user_no,originalPassword, newPassword, confirmPassword)
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
                                if (resultData.result) {
                                    Toast.makeText(
                                        baseContext,
                                        "Success to change the Password",
                                        Toast.LENGTH_SHORT
                                    ).show()
                                    SharedPreValue.setLoginFlag(baseContext, false)
                                    var intent = Intent(baseContext, LogInActivity::class.java)
                                    startActivity(intent)
                                } else {
                                    Toast.makeText(
                                        baseContext,
                                        "Check you original password",
                                        Toast.LENGTH_SHORT
                                    ).show()
                                }
                            }
                            override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                                Log.d("SignIn", "Fail : " + t.message)
                            }
                        })
                }.run()
                dialog.dismiss()
            }else{
                Toast.makeText(baseContext,"The new and confirm password are not same",Toast.LENGTH_SHORT).show()
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
            REQ_CODE_SPEECH_INPUT -> {
                if (resultCode == Activity.RESULT_OK && null != data) {
                    val result = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS)
                    suiteManager.command(result[0])

                    Toast.makeText(this, result!![0], Toast.LENGTH_LONG).show()
                }
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
