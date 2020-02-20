package com.qic.suitecar.ui.dialog

import android.app.Activity
import android.content.Intent
import android.os.Bundle
import android.util.Log
import android.view.View
import com.google.gson.Gson
import com.qic.suitecar.R
import com.qic.suitecar.ui.login.SharedPreValue
import com.qic.suitecar.util.Constants
import com.qic.suitecar.util.Constants.CANCEL
import com.qic.suitecar.util.Constants.EXTRA_DEVICE_ADDRESS
import com.qic.suitecar.util.Constants.OKAY
import com.qic.suitecar.util.IServer
import com.qic.suitecar.util.RetrofitClient
import kotlinx.android.synthetic.main.dialog_addsensor.*
import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.Response

class AddSensorDialog : Activity() {

    private val TAG = "AddSensorDialog"

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.dialog_addsensor)

    }

    fun onClick(view: View) {
        when (view.id) {
            R.id.addSensorScanButton->{
                var intent = Intent(this,DeviceListDialog::class.java)
                startActivityForResult(intent,Constants.SCAN_SENSORS_REQ)
            }
            R.id.addSensorDialogAddButton->{
                val sensorName = addSensorId.text.toString()
                val sensorMac =addSensorMac.text.toString()
                val sensorType = addSensorRadioGroup.indexOfChild(findViewById(addSensorRadioGroup.checkedRadioButtonId))
                val user_no = SharedPreValue.getUserNo(baseContext)

                var retrofit = RetrofitClient.getInstnace()
                var myApi = retrofit.create(IServer::class.java)
                Log.d("sensor Registration", (1 + user_no ).toString()+ Constants.SensorType.values()[sensorType].toString()+ sensorMac+ sensorName)
                Runnable {
                    myApi.sensorRegistration(1, user_no, Constants.SensorType.values()[sensorType].toString(), sensorMac, sensorName)
                            .enqueue(object :
                                    retrofit2.Callback<ResponseBody> {
                                override fun onResponse(
                                        call: Call<ResponseBody>,
                                        response: Response<ResponseBody>
                                ) {
                                    var a = response.body()!!.string()
                                    var gson = Gson()
                                    Log.d("sensor Registration", a)
                                    setResult(OKAY)
                                    finish()
                                }
                                override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                                    Log.d("Close Account", t.message)
                                }
                            })
                }.run()

            }
            R.id.addSensorDialogCancelButton->{
                setResult(CANCEL)
                finish()
            }
        }
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        when(requestCode){
            Constants.SCAN_SENSORS_REQ->{
                if(resultCode==OKAY){
                    addSensorMac.text= data!!.getStringExtra(EXTRA_DEVICE_ADDRESS)
                }else if(resultCode== CANCEL){

                }
            }
        }
    }
}
