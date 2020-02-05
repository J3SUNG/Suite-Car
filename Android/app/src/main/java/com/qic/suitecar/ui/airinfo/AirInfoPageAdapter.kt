package com.qic.suitecar.ui.airinfo

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.fragment.app.Fragment
import androidx.fragment.app.FragmentManager
import androidx.fragment.app.FragmentStatePagerAdapter
import com.github.demono.adapter.InfinitePagerAdapter
import com.qic.suitecar.R

class AirInfoPageAdapter(data:ArrayList<String>) :
    InfinitePagerAdapter() {
    var data=data

    override fun getItemCount(): Int {
        return data.size
    }

    override fun getItemView(position: Int, convertView: View?, container: ViewGroup?): View {
        var mInflater=LayoutInflater.from(container!!.context)
        var view = mInflater.inflate(R.layout.fragment_eachairinfo, container, false)
        return view
    }

}