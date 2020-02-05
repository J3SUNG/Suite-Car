package com.qic.suitecar.ui.setting

import android.content.Context
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.qic.suitecar.R
import kotlinx.android.synthetic.main.item_sensor.view.*

class SensorAdaptor(val context: Context, val sensorInfoList: ArrayList<SensorInfo>) :
    RecyclerView.Adapter<SensorAdaptor.Holder>() {
    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): Holder {
        val view = LayoutInflater.from(context).inflate(R.layout.item_sensor, parent, false)
        return Holder(view)
    }

    override fun getItemCount(): Int {
        return sensorInfoList.size
    }

    override fun onBindViewHolder(holder: Holder, position: Int) {
        holder?.bind(sensorInfoList[position], context)
    }

    inner class Holder(itemView: View) : RecyclerView.ViewHolder(itemView) {
        fun bind(sensorInfo: SensorInfo, context: Context) {
            itemView.sensorImageView.setImageDrawable(context.getDrawable(sensorInfo.img))
            itemView.sensorIdTextView.text = sensorInfo.id
            itemView.sensorMacTextView.text = sensorInfo.mac
        }
    }

}