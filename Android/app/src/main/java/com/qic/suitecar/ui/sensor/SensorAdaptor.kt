package com.qic.suitecar.ui.sensor

import android.content.Context
import android.content.Intent
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.google.gson.Gson
import com.qic.suitecar.MainActivity
import com.qic.suitecar.R
import com.qic.suitecar.ui.dialog.AddSensorActivity
import com.qic.suitecar.util.Constants
import com.qic.suitecar.util.Constants.SensorType.*
import com.qic.suitecar.util.IServer
import com.qic.suitecar.util.PolarSensor
import com.qic.suitecar.util.RetrofitClient
import kotlinx.android.synthetic.main.item_sensor.view.*
import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.Response

class SensorAdaptor(val context: Context, val activity: MainActivity, val sensorInfoList: ArrayList<SensorInfo>) :
        RecyclerView.Adapter<SensorAdaptor.Holder>() {
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): Holder {
        val view = LayoutInflater.from(context).inflate(R.layout.item_sensor, parent, false)
        return Holder(view)
    }

    override fun getItemCount(): Int {
        return sensorInfoList.size
    }

    override fun onBindViewHolder(holder: Holder, position: Int) {
        holder?.bind(sensorInfoList[position], context)
    }

    inner class Holder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        fun bind(sensorInfo: SensorInfo, context: Context) {
            itemView.sensorIdTextView.text = sensorInfo.sname
            itemView.sensorMacTextView.text = sensorInfo.mac_address
            if (sensorInfo.status == 1) {
                itemView.status.setImageDrawable(context.getDrawable(R.drawable.circle_mgreen))
            }
            itemView.itemSensorLayout.setOnLongClickListener {
                activity.showRemoveSensorDialog(sensorInfo)
                true
            }
            when (sensorInfo.type) {
                AddSensor -> {
                    itemView.addSensorLayout.setOnClickListener {
                        var intent = Intent(activity, AddSensorActivity::class.java)
                        activity.startActivityForResult(intent, Constants.ADD_SENSOR_REQ)
                    }
                    itemView.setOnLongClickListener(null)
                    itemView.addSensorLayout.visibility = View.VISIBLE
                    itemView.itemSensorLayout.visibility = View.GONE

                }
                PolarSensor -> {
                    itemView.itemSensorLayout.setOnClickListener {
                        if (sensorInfo.status == 0) {
                            activity.polarSensor.DEVICE_ID = sensorInfo.mac_address
                            activity.polarSensor.sensor_no = sensorInfo.sensor_no
                            Log.d("Start Connecting", activity.polarSensor.DEVICE_ID)
                            activity.polarSensor.connect()
                            activity.HeartThread().start()
                            updateStatus(sensorInfo.sensor_no, 1)

                        } else if(sensorInfo.status == 1) {
                            activity.polarSensor.disconnect()
                            activity.polarSensor.api.shutDown()
                            activity.polarSensor = PolarSensor(context, activity)
                            activity.polarSensor.sensor_no = 0
                            activity.polarSensor.DEVICE_ID = ""
                            updateStatus(sensorInfo.sensor_no, 0)
                        }

                    }
                    itemView.itemSensorLayout.setOnLongClickListener {
                        activity.showRemoveSensorDialog(sensorInfo)
                        true
                    }
                    itemView.addSensorLayout.visibility = View.GONE
                    itemView.itemSensorLayout.visibility = View.VISIBLE
                    itemView.sensorImageView.setImageDrawable(context.getDrawable(R.drawable.ic_heartsensor))
                    itemView.sensorTypeTextView.text = "Heart Sensor"
                }
                InAirSensor -> {
                    itemView.itemSensorLayout.setOnClickListener {
                        if (sensorInfo.status == 0) {
                            activity.bluetoothDevices[sensorInfo.type.ordinal].deviceAddress=sensorInfo.mac_address
                            activity.connect(sensorInfo.type)
                            updateStatus(sensorInfo.sensor_no, 1)
                        } else if(sensorInfo.status == 1) {
                            activity.disconnect(sensorInfo.type)
                            updateStatus(sensorInfo.sensor_no, 0)
                        }
                    }
                    itemView.addSensorLayout.visibility = View.GONE
                    itemView.itemSensorLayout.visibility = View.VISIBLE
                    itemView.sensorImageView.setImageDrawable(context.getDrawable(R.drawable.ic_inair))
                    itemView.sensorTypeTextView.text = "In Air Sensor"
                }
                OutAirSensor -> {
                    itemView.itemSensorLayout.setOnClickListener {
                        if (sensorInfo.status == 0) {
                            activity.bluetoothDevices[sensorInfo.type.ordinal].deviceAddress=sensorInfo.mac_address
                            activity.connect(sensorInfo.type)
                            updateStatus(sensorInfo.sensor_no, 1)
                        } else if(sensorInfo.status == 1) {
                            activity.disconnect(sensorInfo.type)
                            updateStatus(sensorInfo.sensor_no, 0)
                        }
                    }
                    itemView.addSensorLayout.visibility = View.GONE
                    itemView.itemSensorLayout.visibility = View.VISIBLE
                    itemView.sensorImageView.setImageDrawable(context.getDrawable(R.drawable.ic_outair))
                    itemView.sensorTypeTextView.text = "Out Air Sensor"
                }
                Car -> {
                    itemView.itemSensorLayout.setOnClickListener {
                        if (sensorInfo.status == 0) {
                            activity.bluetoothDevices[sensorInfo.type.ordinal].deviceAddress=sensorInfo.mac_address
                            activity.connect(sensorInfo.type)
                            updateStatus(sensorInfo.sensor_no, 1)
                        } else if(sensorInfo.status == 1) {
                            activity.disconnect(sensorInfo.type)
                            updateStatus(sensorInfo.sensor_no, 0)
                        }
                    }
                    itemView.addSensorLayout.visibility = View.GONE
                    itemView.itemSensorLayout.visibility = View.VISIBLE
                    itemView.sensorImageView.setImageDrawable(context.getDrawable(R.drawable.ic_outair))
                    itemView.sensorTypeTextView.text = "Air Sensor"
                }
            }
        }
    }

    fun updateStatus(sensor_no: Int, status: Int) {
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)
        Runnable {
            myApi.sensorAssociation(Constants.ANDROID, sensor_no, status)
                    .enqueue(object :
                            retrofit2.Callback<ResponseBody> {
                        override fun onResponse(
                                call: Call<ResponseBody>,
                                response: Response<ResponseBody>
                        ) {
                            var a = response.body()!!.string()
                            var gson = Gson()
                            Log.d("sensor association", a)
                            activity.loadSensors()
                        }

                        override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                            Log.d("sensor association", t.message)
                        }
                    })
        }.run()
    }
}