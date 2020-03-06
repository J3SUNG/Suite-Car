package com.qic.suitecar.dataclass

import com.qic.suitecar.util.Constants

class SensorInfo ( var sensor_no : Int,
                   var sname:String,
                   var mac_address:String,
                   var type:Constants.SensorType,
                   var status:Boolean)
