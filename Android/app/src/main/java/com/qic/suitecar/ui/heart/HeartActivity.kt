package com.qic.suitecar.ui.heart

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.Handler
import android.os.Message
import android.util.Log
import com.github.mikephil.charting.data.Entry
import com.github.mikephil.charting.data.LineData
import com.github.mikephil.charting.data.LineDataSet
import com.google.gson.Gson
import com.qic.suitecar.R
import com.qic.suitecar.util.IServer
import com.qic.suitecar.util.PolarData
import com.qic.suitecar.util.RetrofitClient
import kotlinx.android.synthetic.main.activity_heart.*
import okhttp3.ResponseBody
import org.json.JSONObject
import retrofit2.Call
import retrofit2.Response

class HeartActivity : AppCompatActivity() {

    var X_RANGE = 20
    var entries = ArrayList<Entry>()
    lateinit var dataSet: LineDataSet

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
        var LYAxis = heartInfoLineChart.axisLeft
        // LYAxis.setAxisMaxValue(200F)
        //    LYAxis.setAxisMinValue(0F)
        heartInfoLineChart.axisRight.isEnabled = false
        var chartUpdateThread = ChartUpdateThread()
        chartUpdateThread.start()
    }

    var handler = object : Handler() {
        override fun handleMessage(msg: Message) {
            chartUpdate()
        }
    }

    private fun chartUpdate() {
        if (entries.size > X_RANGE) {
            entries.removeAt(0)
            for (i in 0 until X_RANGE) {
                entries[i].x = i.toFloat()
            }
        }
        entries.add(Entry(entries.size.toFloat(), PolarData.heartDatas.last().heart.toFloat()))

        dataSet.notifyDataSetChanged()
        heartInfoLineChart.notifyDataSetChanged()
        heartInfoLineChart.invalidate()
    }

    var tFlag = true
    override fun onStop() {
        super.onStop()

        tFlag = false
    }

    inner class ChartUpdateThread : Thread() {
        override fun run() {
            var realTimeHrStack = ArrayList<Float>()
            var realTimeRrStack = ArrayList<Float>()
            while (tFlag) {
                var retrofit = RetrofitClient.getInstnace()
                var myApi = retrofit.create(IServer::class.java)
                if (realTimeHrStack.isEmpty()) {
                    Runnable {
                        myApi.chart2_json(
                            0, 11, 0, 0, "", ""
                        )
                            .enqueue(object :
                                retrofit2.Callback<ResponseBody> {
                                override fun onResponse(
                                    call: Call<ResponseBody>,
                                    response: Response<ResponseBody>
                                ) {
                                    var a = response.body()!!.string()
                                    var gson = Gson()
                                    Log.d("chart2_json", a)
                                    var jsonObject = JSONObject(a)
                                    var cols = jsonObject.getJSONArray("cols")
                                    var rows = jsonObject.getJSONArray("rows")
                                    Log.d(
                                        "chart2_json",
                                        rows.getJSONObject(0).getJSONArray("c").getString(0)
                                    )
                                    for (j in 0 until (rows.length())) {
                                        realTimeHrStack.add(
                                            rows.getJSONObject(j).getJSONArray("c").getJSONObject(
                                                1
                                            ).getDouble(
                                                "v"
                                            ).toFloat()
                                        )
                                        realTimeHrStack.add(
                                            rows.getJSONObject(j).getJSONArray("c").getJSONObject(
                                                2
                                            ).getDouble(
                                                "v"
                                            ).toFloat()
                                        )
                                    }
                                }

                                override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                                    Log.d("chart2_json", t.message)
                                }
                            })
                    }.run()
                }
                sleep(1000)
                var msg = handler.obtainMessage(1, realTimeHrStack[0])
                realTimeHrStack.removeAt(0)
                handler.sendMessage(msg)
            }
        }
    }
}
