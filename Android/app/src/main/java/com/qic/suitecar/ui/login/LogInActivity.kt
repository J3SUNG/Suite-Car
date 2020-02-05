package com.qic.suitecar.ui.login

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import androidx.core.app.ActivityCompat
import com.qic.suitecar.MainActivity
import com.qic.suitecar.R
import kotlinx.android.synthetic.main.activity_login.*

class LogInActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_login)
        if (checkSelfPermission(Manifest.permission.INTERNET) != PackageManager.PERMISSION_GRANTED )
        {
            ActivityCompat.requestPermissions(this, arrayOf(Manifest.permission.INTERNET),
                1
            )
        }
        if(SharedPreValue.getLoginFlag(this)){
            var intent = Intent(this, MainActivity::class.java)
            startActivity(intent)
        }else {
            val fragmentAdapter =
                LogInPageAdapter(supportFragmentManager, 3) //프래그먼트 붙임
            logInViewPager.adapter = fragmentAdapter
            logInTabLayout.setupWithViewPager(logInViewPager)
            logInTabLayout.getTabAt(1)!!.select()
        }
    }
}
