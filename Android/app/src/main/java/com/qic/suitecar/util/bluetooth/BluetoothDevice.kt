package com.qic.suitecar.util.bluetooth

import com.qic.suitecar.MainActivity
import com.qic.suitecar.util.Constants

class BluetoothDevice {
   var socket: SerialSocket? = null
   var service: SerialService? = null
   var initialStart = true
   var connected = Constants.Connected.False
    var deviceAddress: String? = null
    var sensorNo:Int=0
}