package com.qic.suitecar.ui.airinfo

import android.app.Dialog
import android.content.Intent
import android.content.pm.ActivityInfo
import android.graphics.Color
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.os.Handler
import android.os.Message
import android.util.Log
import android.view.View
import android.widget.ArrayAdapter
import com.github.mikephil.charting.data.Entry
import kotlinx.android.synthetic.main.activity_air_info.*
import com.github.mikephil.charting.data.LineDataSet
import com.github.mikephil.charting.data.LineData
import com.github.mikephil.charting.utils.EntryXComparator
import com.google.gson.Gson
import com.qic.suitecar.R
import com.qic.suitecar.dataclass.aqiData
import com.qic.suitecar.ui.dialog.AddSensorDialog
import com.qic.suitecar.ui.dialog.AirInfoOptionDialog
import com.qic.suitecar.ui.login.SharedPreValue
import com.qic.suitecar.util.Constants
import com.qic.suitecar.util.Constants.CANCEL
import com.qic.suitecar.util.Constants.OKAY
import com.qic.suitecar.util.IServer
import com.qic.suitecar.util.PolarData
import com.qic.suitecar.util.RetrofitClient
import kotlinx.android.synthetic.main.activity_heart.*
import okhttp3.ResponseBody
import org.json.JSONObject
import retrofit2.Call
import retrofit2.Response
import java.util.*
import kotlin.collections.ArrayList


class AirInfoActivity : AppCompatActivity() {
    var sensor_no = 0
    var whichData = BooleanArray(5)
    var data = ArrayList<aqiData>()
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_air_info)
        requestedOrientation=ActivityInfo.SCREEN_ORIENTATION_LANDSCAPE
        sensor_no = intent.getStringExtra("SensorNo").toInt()
        var tlqkf=intent.getStringExtra("SensorName")
        Log.d("AirInfoActivity",sensor_no.toString())
        //realTimeAqi()
        whichData[0]=true
        whichData[1]=true
        whichData[2]=true
        whichData[3]=true
        whichData[4]=true
        data.add(aqiData("PM2.5", 30.0F))
        data.add(aqiData("CO", 30.0F))
        data.add(aqiData("O3", 30.0F))
        data.add(aqiData( "SO2", 30.0F))
        data.add(aqiData( "NO2", 30.0F))
        airInfoViewPager.adapter = AirInfoPageAdapter(data, this)
        airInfoViewPager.startAutoScroll()
        chartInit()
        airInfoSpinner.text=tlqkf
    }

    var aqiDataSets = ArrayList<LineDataSet>()
    var entriesList = ArrayList<ArrayList<Entry>>()
    lateinit var lineData: LineData
    private fun chartInit() {
        airInfoLineChart.isAutoScaleMinMaxEnabled = true
        for (i in 0..5) {
            entriesList.add(ArrayList())
        }
        aqiDataSets.add(LineDataSet(entriesList[0], "co"))
        aqiDataSets.add(LineDataSet(entriesList[1], "so2"))
        aqiDataSets.add(LineDataSet(entriesList[2], "no2s"))
        aqiDataSets.add(LineDataSet(entriesList[3], "o3"))
        aqiDataSets.add(LineDataSet(entriesList[4], "pm25"))
        aqiDataSets.add(LineDataSet(entriesList[5], "temperature"))

        aqiDataSets[0].color= Color.RED
        aqiDataSets[1].color=Color.DKGRAY
        aqiDataSets[2].color=Color.GREEN
        aqiDataSets[3].color=Color.BLUE
        aqiDataSets[4].color=Color.CYAN
        aqiDataSets[5].color=Color.MAGENTA
        //TODO : Dataset visible로 해보자

        lineData = LineData(aqiDataSets.toList())
        airInfoLineChart.data = lineData
        var LYAxis = airInfoLineChart.axisLeft
        // LYAxis.setAxisMaxValue(200F)
        //    LYAxis.setAxisMinValue(0F)
        airInfoLineChart.axisRight.isEnabled = false
        airInfoLineChart.isAutoScaleMinMaxEnabled = true
        var chartUpdateThread = ChartUpdateThread()
        chartUpdateThread.start()

    }

    fun onClick(view: View) {
        when (view.id) {
            R.id.airInfoSettingButton -> {
                showDialog()
            }
            R.id.airInfoLeftButton -> {
                airInfoViewPager.currentItem--
            }
            R.id.airInfoRightButton -> {
                airInfoViewPager.currentItem++
            }
        }
    }

    private fun showDialog() {
        var intent = Intent(this, AirInfoOptionDialog::class.java)
        intent.putExtra("WhichData",whichData)
        startActivityForResult(intent, Constants.AIR_INFO_OPTION_REQ)
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        when (requestCode) {
            Constants.AIR_INFO_OPTION_REQ -> {
                when (resultCode) {
                    OKAY -> {
                        //if(!intent.hasExtra("WhichData")) return
                         var z = data!!.getBooleanArrayExtra("WhichData")
                        Log.d("whichData",z[0].toString()+z[1].toString()+z[2].toString()+z[3].toString()+z[4].toString())

                        whichData=z
                        if (data!!.getIntExtra("ViewType", 0) == 0) {
                            realTimeAqi()
                            airInfoTypeTextView.text="RealTime AQI"
                        } else {
                            airInfoTypeTextView.text="Historical AQI"
                            val startDate = data!!.getStringExtra("StartDate")
                            val endDate = data!!.getStringExtra("EndDate")
                            historicalAqi(
                                SharedPreValue.getUserNo(baseContext),
                                sensor_no,
                                startDate,
                                endDate
                            )
                        }
                    }
                    CANCEL -> {

                    }
                }

            }
        }
    }

    private fun historicalAqi(user_no: Int, sensor_no: Int, startDate: String, endDate: String) {
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)

        Runnable {
            myApi.chart2_json(
                user_no, sensor_no, 0, 1, startDate, endDate
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
                        ///
                        /*
                        for (i in 1..5) {
                            var entries = ArrayList<Entry>()
                            for (j in 0 until (rows.length()))
                                entries.add(
                                    Entry(
                                        j.toFloat(),
                                        rows.getJSONObject(j).
                                            getJSONArray("c").getJSONObject(i).getDouble(
                                            "v"
                                        ).toFloat()
                                    )
                                )
                            var dataSet = LineDataSet(entries, "# of calls")

                            dataSets.add(dataSet)
                        }
                        */
                        var entries = ArrayList<Entry>()
                        for (j in 0 until (rows.length()))
                            entries.add(
                                Entry(
                                    j.toFloat(),
                                    rows.getJSONObject(j).
                                        getJSONArray("c").getJSONObject(1).getDouble(
                                        "v"
                                    ).toFloat()
                                )
                            )
                        var dataSet = LineDataSet(entries, "CO")
                        dataSet.color=Color.RED
                        dataSets.add(dataSet)

                        entries = ArrayList<Entry>()
                        for (j in 0 until (rows.length()))
                            entries.add(
                                Entry(
                                    j.toFloat(),
                                    rows.getJSONObject(j).
                                        getJSONArray("c").getJSONObject(2).getDouble(
                                        "v"
                                    ).toFloat()
                                )
                            )
                        dataSet = LineDataSet(entries, "SO2")
                        dataSet.color=Color.DKGRAY
                        dataSets.add(dataSet)

                        entries = ArrayList<Entry>()
                        for (j in 0 until (rows.length()))
                            entries.add(
                                Entry(
                                    j.toFloat(),
                                    rows.getJSONObject(j).
                                        getJSONArray("c").getJSONObject(3).getDouble(
                                        "v"
                                    ).toFloat()
                                )
                            )
                        dataSet = LineDataSet(entries, "NO2")
                        dataSet.color=Color.GREEN
                        dataSets.add(dataSet)

                        entries = ArrayList<Entry>()
                        for (j in 0 until (rows.length()))
                            entries.add(
                                Entry(
                                    j.toFloat(),
                                    rows.getJSONObject(j).
                                        getJSONArray("c").getJSONObject(4).getDouble(
                                        "v"
                                    ).toFloat()
                                )
                            )
                        dataSet = LineDataSet(entries, "O3")
                        dataSet.color=Color.BLUE
                        dataSets.add(dataSet)

                        entries = ArrayList<Entry>()
                        for (j in 0 until (rows.length()))
                            entries.add(
                                Entry(
                                    j.toFloat(),
                                    rows.getJSONObject(j).
                                        getJSONArray("c").getJSONObject(5).getDouble(
                                        "v"
                                    ).toFloat()
                                )
                            )
                        dataSet = LineDataSet(entries, "PM2.5")
                        dataSet.color=Color.CYAN
                        dataSets.add(dataSet)
                        ///
                        var data = LineData(dataSets.toList())
                        airInfoLineChart.data = data

                        airInfoLineChart.notifyDataSetChanged()
                        airInfoLineChart.invalidate()
                    }

                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                        Log.d("chart2_json", t.message)
                    }
                })
        }.run()
    }

    var chartUpdateThread: ChartUpdateThread? = null
    private fun realTimeAqi() {
        for(i in entriesList){
           // i.removeAll()
        }
        if (chartUpdateThread == null) {
            tFlag = true
            chartUpdateThread = ChartUpdateThread()
            chartUpdateThread!!.start()
        }
    }
    var X_RANGE = 20
    override fun onStop() {
        super.onStop()

        tFlag = false
    }

    var count = 0
    private fun chartUpdate() {
        if (realTimeEntry[0].isNotEmpty()) {
            if (entriesList[0].size == 1) tFlag = true
            for (i in 0..4) {
                if (entriesList[i].size > X_RANGE) {
                    entriesList[i].removeAt(0)
                    for (j in 0 until X_RANGE) {
                        entriesList[i][j].x = j.toFloat()
                    }
                }
                entriesList[i].add(Entry(entriesList[i].size.toFloat(), realTimeEntry[i][0]))
                data[i].data=realTimeEntry[i][0]

                realTimeEntry[i].removeAt(0)
                //var a = Collections.sort(entriesList[i], EntryXComparator())
                aqiDataSets[i].notifyDataSetChanged()
                aqiDataSets[i].isVisible=whichData[i]
            }

            airInfoLineChart.data.notifyDataChanged()
            airInfoLineChart.notifyDataSetChanged()
            airInfoLineChart.invalidate()

        }


    }

    var tFlag = true
    lateinit var realTimeEntry: ArrayList<ArrayList<Float>>

    inner class ChartUpdateThread : Thread() {
        override fun run() {
            realTimeEntry = ArrayList()
            var waitFlag = false
            for (i in 0..5) realTimeEntry.add(ArrayList())
            while (tFlag) {
                sleep(1000)
                var retrofit = RetrofitClient.getInstnace()
                var myApi = retrofit.create(IServer::class.java)
                if (realTimeEntry[0].isEmpty()) {
                    if (!waitFlag) {
                        waitFlag = true
                        Log.d("realTimeEntry",sensor_no.toString())
                        Runnable {
                            myApi.chart2_json(
                               0, sensor_no, 0, 0, "", ""
                            )
                                .enqueue(object :
                                    retrofit2.Callback<ResponseBody> {
                                    override fun onResponse(
                                        call: Call<ResponseBody>,
                                        response: Response<ResponseBody>
                                    ) {
                                        Log.d("tlqkf","뒤지고싶다")
                                        waitFlag = false
                                        var a = response.body()!!.string()
                                        var gson = Gson()
                                        Log.d("chart2_json", a)
                                        if(a.isEmpty()){
                                            tFlag=false
                                            return
                                        }
                                        var jsonObject = JSONObject(a)
                                        var cols = jsonObject.getJSONArray("cols")
                                        var rows = jsonObject.getJSONArray("rows")
                                        Log.d(
                                            "chart2_json",
                                            rows.getJSONObject(0).getJSONArray("c").getString(0)
                                        )
                                        for (i in 0 until (rows.length())) {
                                            for (j in 0 until 5) {
                                                realTimeEntry[j].add(
                                                    rows.getJSONObject(i).getJSONArray("c").getJSONObject(
                                                        j + 1
                                                    ).getDouble(
                                                        "v"
                                                    ).toFloat()
                                                )
                                            }
                                        }
                                    }

                                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                                        Log.d("chart2_json", t.message)
                                    }
                                })
                        }.run()
                    }
                } else {
                    chartUpdate()
                }
            }
        }
    }
}
