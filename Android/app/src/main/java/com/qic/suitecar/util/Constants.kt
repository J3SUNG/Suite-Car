package com.qic.suitecar.util

import com.qic.suitecar.BuildConfig

object Constants {

    const val OKAY=0
    const val CANCEL = 1

    const val ADD_SENSOR_REQ = 0
    const val SCAN_SENSORS_REQ=1
    const val SPEECH_INPUT_REQ = 2
    const val AIR_INFO_OPTION_REQ = 3
    const val HEART_INFO_OPTION_REQ = 3
    const val EXTRA_DEVICE_ADDRESS = "device_address"


    val WEB=0
    val ANDROID=1

    enum class SensorType{
        POLARSENSOR,
        INAIRSENSOR,
        OUTAIRSENSOR,
        CAR,
        ADDSENSOR
    }


    // values have to be globally unique
    val INTENT_ACTION_DISCONNECT = BuildConfig.APPLICATION_ID + ".Disconnect"
    val NOTIFICATION_CHANNEL = BuildConfig.APPLICATION_ID + ".Channel"
    val INTENT_CLASS_MAIN_ACTIVITY = BuildConfig.APPLICATION_ID + ".MainActivity"

    // values have to be unique within each app
    val NOTIFY_MANAGER_START_FOREGROUND_SERVICE = 1001

    enum class Connected {
        False, Pending, True
    }

    const val CO=0
    const val SO2=1
    const val NO2=2
    const val O3=3
    const val PM25=4
    const val TEMP=5

}