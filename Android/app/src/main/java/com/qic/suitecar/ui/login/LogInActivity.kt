package com.qic.suitecar.ui.login

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.qic.suitecar.R
import kotlinx.android.synthetic.main.activity_login.*

class LogInActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)
        val fragmentAdapter =
            LogInPageAdapter(supportFragmentManager, 3) //프래그먼트 붙임
        logInViewPager.adapter = fragmentAdapter
        logInTabLayout.setupWithViewPager(logInViewPager)
        logInTabLayout.getTabAt(1)!!.select()
    }
}
