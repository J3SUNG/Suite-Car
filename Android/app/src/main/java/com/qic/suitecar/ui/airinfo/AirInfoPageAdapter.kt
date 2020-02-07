package com.qic.suitecar.ui.airinfo

import android.content.Context
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.github.demono.adapter.InfinitePagerAdapter
import com.qic.suitecar.R
import com.qic.suitecar.dataclass.aqiData
import kotlinx.android.synthetic.main.fragment_eachaqi.view.*

class AirInfoPageAdapter(data: ArrayList<aqiData>, context: Context) : InfinitePagerAdapter() {
    var data = data
    var context = context
    override fun getItemCount(): Int {
        return data.size
    }

    override fun getItemView(position: Int, convertView: View?, container: ViewGroup?): View {
        var mInflater = LayoutInflater.from(container!!.context)
        var view = mInflater.inflate(R.layout.fragment_eachaqi, container, false)
        view.eachAQIImageView.setImageDrawable(context.getDrawable(data[position].img))
        view.eachAQIIdTextView.text = data[position].type.toString()
        view.eachAQIDataTextView.text = data[position].data.toInt().toString()
        return view
    }

}