package com.qic.suitecar.ui.setting

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.LinearLayout
import androidx.fragment.app.Fragment
import androidx.recyclerview.widget.LinearLayoutManager
import com.qic.suitecar.R
import kotlinx.android.synthetic.main.fragment_setting.view.*

class SettingFragment : Fragment() {


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val root = inflater.inflate(R.layout.fragment_setting, container, false)

        var sensors=ArrayList<SensorInfo>()
        sensors.add(SensorInfo(R.drawable.logo,"뿌앵","뿌애앵"))
        sensors.add(SensorInfo(R.drawable.logo,"뿌앵","뿌애앵"))
        sensors.add(SensorInfo(R.drawable.logo,"뿌앵","뿌애앵"))
        root.sensorRecyclerView.adapter=SensorAdaptor(context!!,sensors)
        root.sensorRecyclerView.layoutManager=LinearLayoutManager(context)


        return root
    }
}