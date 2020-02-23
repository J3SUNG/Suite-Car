package com.qic.suitecar.ui.heart

import android.content.Intent
import android.content.pm.ActivityInfo
import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.Handler
import android.os.Message
import android.util.Log
import android.view.View
import com.github.mikephil.charting.data.*
import com.google.gson.Gson
import com.qic.suitecar.ui.login.SharedPreValue
import com.qic.suitecar.util.IServer
import com.qic.suitecar.util.PolarData
import com.qic.suitecar.util.RetrofitClient
import kotlinx.android.synthetic.main.activity_heart.*
import okhttp3.ResponseBody
import org.json.JSONObject
import retrofit2.Call
import retrofit2.Response
import com.github.mikephil.charting.charts.CombinedChart
import com.github.mikephil.charting.components.YAxis
import com.qic.suitecar.R
import com.qic.suitecar.ui.dialog.AirInfoOptionDialog
import com.qic.suitecar.ui.dialog.HeartInfoOptionDialog
import com.qic.suitecar.util.Constants
import kotlinx.android.synthetic.main.activity_air_info.*


class HeartActivity : AppCompatActivity() {

    var X_RANGE = 20
    var hrEntries = ArrayList<Entry>()
    var rrEntries = ArrayList<BarEntry>()
    lateinit var hrDataSet: LineDataSet
    lateinit var rrDataSet: BarDataSet
    var sensorNo = 0
    lateinit var realTimeHrStack: ArrayList<Float>
    lateinit var realTimeRrStack: ArrayList<Float>
    lateinit var combinedData: CombinedData
    var chartUpdateThread = ChartUpdateThread()
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_heart)
        requestedOrientation = ActivityInfo.SCREEN_ORIENTATION_LANDSCAPE
        sensorNo = intent.getIntExtra("SensorNo", 0)
        init()
    }

    private fun init() {
        chartInit()
    }

    private fun chartInit() {
        heartInfoCombinedChart.isAutoScaleMinMaxEnabled = true

        hrDataSet = LineDataSet(hrEntries, "hr")
        hrDataSet.color = Color.RED
        hrDataSet.axisDependency = YAxis.AxisDependency.LEFT
        rrDataSet = BarDataSet(rrEntries, "rr")
        rrDataSet.color = Color.YELLOW
        rrDataSet.axisDependency = YAxis.AxisDependency.RIGHT
        var lineData = LineData(hrDataSet)
        var barData = BarData(rrDataSet)
        combinedData = CombinedData()
        combinedData.setData(lineData)
        combinedData.setData(barData)

        heartInfoCombinedChart.data = combinedData
        var LYAxis = heartInfoCombinedChart.axisLeft
        // LYAxis.setAxisMaxValue(200F)
        //    LYAxis.setAxisMinValue(0F)
        heartInfoCombinedChart.axisRight.isEnabled = true
        heartInfoCombinedChart.description.isEnabled = false
        heartInfoCombinedChart.setDrawGridBackground(false)

        chartUpdateThread.start()
    }

    private fun showDialog() {
        var intent = Intent(this, HeartInfoOptionDialog::class.java)
        startActivityForResult(intent, Constants.HEART_INFO_OPTION_REQ)
    }

    private fun chartUpdate() {
        if (realTimeHrStack.isNotEmpty()) {
            if (hrEntries.size > X_RANGE) {
                hrEntries.removeAt(0)
                rrEntries.removeAt(0)
                for (i in 0 until X_RANGE) {
                    hrEntries[i].x = i.toFloat()
                    rrEntries[i].x = i.toFloat()
                }
            }
            hrEntries.add(Entry(hrEntries.size.toFloat(), realTimeHrStack.first()))
            rrEntries.add(BarEntry(rrEntries.size.toFloat(), realTimeRrStack.first()))

            realTimeHrStack.removeAt(0)
            realTimeRrStack.removeAt(0)

            rrDataSet.notifyDataSetChanged()
            hrDataSet.notifyDataSetChanged()
            combinedData.barData.notifyDataChanged()
            combinedData.lineData.notifyDataChanged()
            combinedData.notifyDataChanged()

            heartInfoCombinedChart.notifyDataSetChanged()
            heartInfoCombinedChart.invalidate()
        }
    }

    var tFlag = true
    override fun onStop() {
        super.onStop()
        tFlag = false
    }

    inner class ChartUpdateThread : Thread() {
        override fun run() {
            realTimeHrStack = ArrayList()
            realTimeRrStack = ArrayList()
            while (tFlag) {
                var retrofit = RetrofitClient.getInstnace()
                var myApi = retrofit.create(IServer::class.java)
                var userno = SharedPreValue.getUserNo(baseContext)
                Log.d("ChartUpdateThread", sensorNo.toString())
                if (realTimeHrStack.isEmpty()) {
                    Runnable {
                        myApi.chart2_json(
                            userno, sensorNo, 1, 0, "", ""
                        )
                            .enqueue(object :
                                retrofit2.Callback<ResponseBody> {
                                override fun onResponse(
                                    call: Call<ResponseBody>,
                                    response: Response<ResponseBody>
                                ) {
                                    var a = response.body()!!.string()
                                    if (a.isEmpty()) {
                                        tFlag = false
                                        return
                                    }
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
                                        realTimeRrStack.add(
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
                chartUpdate()
            }
        }
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        when (requestCode) {
            Constants.HEART_INFO_OPTION_REQ -> {
                when (resultCode) {
                    Constants.OKAY -> {
                        if (data!!.getIntExtra("ViewType", 0) == 0) {
                            realTimeHeart()
                        } else {
                            val startDate = data!!.getStringExtra("StartDate")
                            val endDate = data!!.getStringExtra("EndDate")
                            historicalHeart(
                                SharedPreValue.getUserNo(baseContext),
                                sensorNo,
                                startDate,
                                endDate
                            )
                        }
                    }
                    Constants.CANCEL -> {
                    }
                }
            }
        }
    }

    private fun historicalHeart(userNo: Int, sensorNo: Int, startDate: String, endDate: String) {
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)
        Log.d("historicalHeart",userNo.toString())
        Runnable{
            myApi.chart2_json(
                userNo, 22, 1, 1, "2020-02-21 00:00:50", "2020-02-22 00:01:00"
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
                        Log.d("chart2_json", rows.getJSONObject(0).getJSONArray("c").getString(0))
                        var dataSets = ArrayList<LineDataSet>()


                        for (j in 0 until (rows.length())) {
                            realTimeHrStack.add(
                                rows.getJSONObject(j).getJSONArray("c").getJSONObject(
                                    1
                                ).getDouble(
                                    "v"
                                ).toFloat()
                            )
                            realTimeRrStack.add(
                                rows.getJSONObject(j).getJSONArray("c").getJSONObject(
                                    2
                                ).getDouble(
                                    "v"
                                ).toFloat()
                            )
                        }
                        for (i in realTimeHrStack.indices) {
                            hrEntries.add(
                                Entry(
                                    hrEntries.size.toFloat(),
                                    realTimeHrStack[i]
                                )
                            )
                            rrEntries.add(
                                BarEntry(
                                    rrEntries.size.toFloat(),
                                    realTimeRrStack[i]
                                )
                            )
                        }
                        realTimeHrStack = ArrayList()
                        realTimeRrStack = ArrayList()

                        rrDataSet.notifyDataSetChanged()
                        hrDataSet.notifyDataSetChanged()
                        combinedData.barData.notifyDataChanged()
                        combinedData.lineData.notifyDataChanged()
                        combinedData.notifyDataChanged()

                        heartInfoCombinedChart.notifyDataSetChanged()
                        heartInfoCombinedChart.invalidate()

                    }

                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                        Log.d("chart2_json", t.message)
                    }
                })
        }.run()
    }


    private fun realTimeHeart() {
        if (chartUpdateThread == null) {
            tFlag = true
            chartUpdateThread = ChartUpdateThread()
            chartUpdateThread!!.start()
        }
    }

    fun onClick(view: View) {
        when (view.id) {
            R.id.heartInfoSettingButton -> {
                showDialog()
            }
        }
    }
}
