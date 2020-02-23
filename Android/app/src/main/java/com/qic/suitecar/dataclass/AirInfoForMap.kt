package com.qic.suitecar.dataclass

data class AirInfoForMap(
        var Air_data_no:Int,
        var sensor_no:Int,
        var time:String,
        var CO_raw:Double,
        var CO_aqi:Double,
        var SO2_raw:Double,
        var SO2_aqi:Double,
        var NO2_raw:Double,
        var NO2_aqi:Double,
        var O3_raw:Double,
        var O3_aqi:Double,
        var PM25_raw:Double,
        var PM25_Aqi:Double,
        var lat:Double,
        var lng:Double,
        var sname:String,
        var temperature:String
)