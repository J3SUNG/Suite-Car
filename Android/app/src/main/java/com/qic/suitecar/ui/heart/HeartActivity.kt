package com.qic.suitecar.ui.heart

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.Handler
import android.os.Message
import com.github.mikephil.charting.data.Entry
import com.github.mikephil.charting.data.LineData
import com.github.mikephil.charting.data.LineDataSet
import com.qic.suitecar.R
import com.qic.suitecar.util.PolarData
import kotlinx.android.synthetic.main.activity_heart.*

class HeartActivity : AppCompatActivity() {

    var X_RANGE=20
    var entries = ArrayList<Entry>()
    lateinit var dataSet:LineDataSet

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_heart)
        init()
    }

    private fun init() {
        chartInit()
    }

    private fun chartInit() {
        heartInfoLineChart.isAutoScaleMinMaxEnabled = true

        for (i in PolarData.heartDatas.indices) {
            entries.add(Entry(i.toFloat(), PolarData.heartDatas[i].heart.toFloat()))
        }
        dataSet = LineDataSet(entries, "# of calls")

        var linedata = LineData(dataSet)
        heartInfoLineChart.data = linedata
        var LYAxis=heartInfoLineChart.axisLeft
       // LYAxis.setAxisMaxValue(200F)
         //    LYAxis.setAxisMinValue(0F)
        heartInfoLineChart.axisRight.isEnabled=false
        var chartUpdateThread=ChartUpdateThread()
        chartUpdateThread.start()
    }
    var handler=object : Handler(){
        override fun handleMessage(msg: Message) {
            chartUpdate()
        }
    }

    private fun chartUpdate() {
        if(entries.size>X_RANGE) {
            entries.removeAt(0)
        for (i in 0 until X_RANGE) {
                entries[i].x = i.toFloat()
            }
        }
        entries.add(Entry(entries.size.toFloat(),PolarData.heartDatas.last().heart.toFloat()))

        dataSet.notifyDataSetChanged()
        heartInfoLineChart.notifyDataSetChanged()
        heartInfoLineChart.invalidate()
    }

    inner class ChartUpdateThread: Thread() {
        override fun run() {
            while(true){
                sleep(1000)
                handler.sendEmptyMessage(0)
            }
        }
    }
}
