package com.qic.suitecar.ui.airinfo

import android.app.Dialog
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.View
import android.widget.ArrayAdapter
import com.github.mikephil.charting.data.Entry
import kotlinx.android.synthetic.main.activity_air_info.*
import com.github.mikephil.charting.data.LineDataSet
import com.github.mikephil.charting.data.LineData
import com.qic.suitecar.R
import com.qic.suitecar.dataclass.aqiData
import kotlinx.android.synthetic.main.activity_main.*


class AirInfoActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_air_info)
        var data = ArrayList<aqiData>()
        data.add(aqiData(R.drawable.test,"AQI",30.0F))
        data.add(aqiData(R.drawable.test,"PM10",30.0F))
        data.add(aqiData(R.drawable.test,"PM2.5",30.0F))
        data.add(aqiData(R.drawable.test,"CO",30.0F))
        data.add(aqiData(R.drawable.test,"O3",30.0F))
        data.add(aqiData(R.drawable.test,"SO2",30.0F))
        data.add(aqiData(R.drawable.test,"NO2",30.0F))
        airInfoViewPager.adapter = AirInfoPageAdapter(data,this)
        airInfoViewPager.startAutoScroll()
        setChart()
        var sensorList=arrayOf("Sensor1","Sensor2","Sensor3")
        var array_adapter=ArrayAdapter(this,R.layout.item_spinner_sensor,sensorList)
        array_adapter.setDropDownViewResource(R.layout.support_simple_spinner_dropdown_item)
        airInfoSpinner.adapter=array_adapter
    }

    private fun setChart() {
        var dataSets = ArrayList<LineDataSet>()
        val labels = ArrayList<String>()
        labels.add("January")
        labels.add("February")
        labels.add("March")
        labels.add("April")
        labels.add("May")
        labels.add("June")
        labels.add("July")
        labels.add("August")
        labels.add("September")
        labels.add("October")
        labels.add("November")
        labels.add("December")
        for (i in 1..3) {
            var entries = ArrayList<Entry>()
            entries.add(Entry(0f, 4f + i))
            entries.add(Entry(1f, 8f + i))
            entries.add(Entry(2f, 6f + i))
            entries.add(Entry(3f, 2f + i))
            entries.add(Entry(4f, 18f + i))
            entries.add(Entry(5f, 9f + i))
            entries.add(Entry(6f, 16f + i))
            entries.add(Entry(7f, 5f + i))
            entries.add(Entry(8f, 3f + i))
            entries.add(Entry(10f, 7f + i))
            entries.add(Entry(11f, 9f + i))
            var dataSet = LineDataSet(entries, "# of calls")

            dataSets.add(dataSet)
        }
        var data = LineData(dataSets.toList())
        airInfoLineChart.data = data
    }

    fun onClick(view: View) {
        when (view.id) {
            R.id.airInfoSettingButton->{
                showDialog()
            }
            R.id.airInfoLeftButton->{
                airInfoViewPager.currentItem--
            }
            R.id.airInfoRightButton->{
                airInfoViewPager.currentItem++
            }
        }
    }

    private fun showDialog() {
        var dialog = Dialog(this)
        dialog.setContentView(R.layout.dialog_airinfo)
        dialog.setTitle("Air Information")
        dialog.setCancelable(true)
        dialog.show()
    }

}
