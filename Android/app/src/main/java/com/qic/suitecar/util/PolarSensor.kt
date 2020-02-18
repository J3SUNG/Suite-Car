package com.qic.suitecar.util

import android.app.Activity
import android.content.Context
import android.util.Log
import com.qic.suitecar.MainActivity
import com.qic.suitecar.dataclass.heartData
import io.reactivex.android.schedulers.AndroidSchedulers
import io.reactivex.disposables.Disposable
import kotlinx.android.synthetic.main.activity_main.*
import polar.com.sdk.api.PolarBleApi
import polar.com.sdk.api.PolarBleApiCallback
import polar.com.sdk.api.PolarBleApiDefaultImpl
import polar.com.sdk.api.errors.PolarInvalidArgument
import polar.com.sdk.api.model.PolarDeviceInfo
import polar.com.sdk.api.model.PolarExerciseEntry
import polar.com.sdk.api.model.PolarHrData
import java.util.*

class PolarSensor {
    var TAG = "POLAR"
    lateinit var api: PolarBleApi
    internal var broadcastDisposable: Disposable? = null
    internal var ecgDisposable: Disposable? = null
    internal var accDisposable: Disposable? = null
    internal var ppgDisposable: Disposable? = null
    internal var ppiDisposable: Disposable? = null

    internal var scanDisposable: Disposable? = null
    internal var sensor_no=0
    internal var DEVICE_ID =
        "0" // or bt address like F5:A7:B8:EF:7A:D1 // TODO replace with your device id
    internal var autoConnectDisposable: Disposable? = null
    internal var exerciseEntry: PolarExerciseEntry? = null
    var context: Context
    var activity: Activity

    constructor(context: Context, activity: Activity) {
        this.context = context
        this.activity = activity
        api = PolarBleApiDefaultImpl.defaultImplementation(context, PolarBleApi.ALL_FEATURES)
        api.setPolarFilter(false)
        api.setApiCallback(object : PolarBleApiCallback() {
            override fun blePowerStateChanged(powered: Boolean) {
                Log.d(TAG, "BLE power: $powered")
            }

            override fun deviceConnected(polarDeviceInfo: PolarDeviceInfo) {
                Log.d(TAG, "CONNECTED: " + polarDeviceInfo!!.deviceId)
                DEVICE_ID = polarDeviceInfo.deviceId
                (activity as MainActivity).heartThread.start()
            }


            override fun deviceConnecting(polarDeviceInfo: PolarDeviceInfo) {
                Log.d(TAG, "CONNECTING: " + polarDeviceInfo!!.deviceId)
                DEVICE_ID = polarDeviceInfo.deviceId
            }

            override fun deviceDisconnected(polarDeviceInfo: PolarDeviceInfo) {
                Log.d(TAG, "DISCONNECTED: " + polarDeviceInfo!!.deviceId)
                ecgDisposable = null
                accDisposable = null
                ppgDisposable = null
                ppiDisposable = null
            }

            override fun ecgFeatureReady(identifier: String) {
                Log.d(TAG, "ECG READY: " + identifier!!)
                // ecg streaming can be started now if needed
            }

            override fun accelerometerFeatureReady(identifier: String) {
                Log.d(TAG, "ACC READY: " + identifier!!)
                // acc streaming can be started now if needed
            }

            override fun ppgFeatureReady(identifier: String) {
                Log.d(TAG, "PPG READY: " + identifier!!)
                // ohr ppg can be started
            }

            override fun ppiFeatureReady(identifier: String) {
                Log.d(TAG, "PPI READY: " + identifier!!)
                // ohr ppi can be started
            }

            override fun biozFeatureReady(identifier: String) {
                Log.d(TAG, "BIOZ READY: " + identifier!!)
                // ohr ppi can be started
            }

            override fun hrFeatureReady(identifier: String) {
                Log.d(TAG, "HR READY: " + identifier!!)
                // hr notifications are about to start
            }

            override fun disInformationReceived(identifier: String, uuid: UUID, value: String) {
                Log.d(TAG, "uuid: $uuid value: $value")

            }

            override fun batteryLevelReceived(identifier: String, level: Int) {
                Log.d(TAG, "BATTERY LEVEL: $level")

            }

            override fun hrNotificationReceived(identifier: String, data: PolarHrData) {
                Log.d(
                    TAG,
                    "HR value: " + data!!.hr + " rrsMs: " + data.rrsMs + " rr: " + data.rrs + " contact: " + data.contactStatus + "," + data.contactStatusSupported
                )
                if(data.rrs.isNotEmpty()) {
                    if (PolarData.heartDatas.size > 10) {
                        PolarData.heartDatas.removeAt(0)
                    }
                    PolarData.heartDatas.add(heartData(data.hr, data.rrs[0]))
                }
            }

            override fun polarFtpFeatureReady(s: String) {
                Log.d(TAG, "FTP ready")
            }
        })
        initListener()
    }

    fun broadcast() {
        if (broadcastDisposable == null) {
            broadcastDisposable = api.startListenForPolarHrBroadcasts(null).subscribe(
                { polarBroadcastData ->
                    Log.d(
                        TAG, "HR BROADCAST " +
                                polarBroadcastData.polarDeviceInfo.deviceId + " HR: " +
                                polarBroadcastData.hr + " batt: " +
                                polarBroadcastData.batteryStatus
                    )
                },
                { throwable -> Log.e(TAG, "" + throwable.localizedMessage!!) },
                { Log.d(TAG, "complete") }
            )
        } else {
            broadcastDisposable!!.dispose()
            broadcastDisposable = null
        }
    }

    fun connect() {
        try {
            api.connectToDevice(DEVICE_ID)
            Log.d("connect tlqkf",DEVICE_ID)
            (activity as MainActivity).polar_flag=true
        } catch (polarInvalidArgument: PolarInvalidArgument) {
            polarInvalidArgument.printStackTrace()
        }
    }

    fun disconnect() {
        try {
            api.disconnectFromDevice(DEVICE_ID)
            (activity as MainActivity).polar_flag=false
            PolarData.heartDatas.clear()

        } catch (polarInvalidArgument: PolarInvalidArgument) {
            polarInvalidArgument.printStackTrace()
        }
    }

    fun scan() {
        if (scanDisposable == null) {
            scanDisposable =
                api.searchForDevice().observeOn(AndroidSchedulers.mainThread()).subscribe(
                    { polarDeviceInfo ->
                        Log.d(
                            TAG,
                            "polar device found id: " + polarDeviceInfo.deviceId + " address: " + polarDeviceInfo.address + " rssi: " + polarDeviceInfo.rssi + " name: " + polarDeviceInfo.name + " isConnectable: " + polarDeviceInfo.isConnectable
                        )
                    },
                    { throwable -> Log.d(TAG, "" + throwable.localizedMessage!!) },
                    { Log.d(TAG, "complete") }
                )
        } else {
            scanDisposable!!.dispose()
            scanDisposable = null
        }
    }

    private fun initListener() {
      //  connect()
        /* activity.broadcast_button.setOnClickListener{
             broadcast()
         }
         activity.connect_button.setOnClickListener{
             connect()
         }
         activity.disconnect_button.setOnClickListener{
             disconnect()
         }
         activity.scan_button.setOnClickListener{
             scan()
         }*/
    }

}