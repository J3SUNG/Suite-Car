package com.qic.suitecar

import android.Manifest
import android.content.Context
import android.content.pm.PackageManager
import android.os.Bundle
import android.view.View
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.drawerlayout.widget.DrawerLayout
import com.google.android.gms.maps.SupportMapFragment
import com.qic.suitecar.util.Map
import com.qic.suitecar.util.TTS
import kotlinx.android.synthetic.main.activity_main.*

class MainActivity : AppCompatActivity() {
    private val multiplePermissionsCode = 100          //권한
    private val requiredPermissions = arrayOf(
        Manifest.permission.ACCESS_FINE_LOCATION,
        Manifest.permission.ACCESS_COARSE_LOCATION,
        Manifest.permission.ACCESS_BACKGROUND_LOCATION,
        Manifest.permission.READ_EXTERNAL_STORAGE
    )

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)
        checkPermissions()
        TTS.set(this)
        var smf=supportFragmentManager.findFragmentById(R.id.googleMap) as SupportMapFragment
        var map = Map(smf, this)
        drawerLayout.setDrawerLockMode(DrawerLayout.LOCK_MODE_LOCKED_CLOSED)
    }

    fun onClick(view: View){
        when(view.id){
            R.id.openDrawerButton -> {
                drawerLayout.openDrawer(drawer)
            }
            R.id.closeDrawerButton -> {
                drawerLayout.closeDrawer(drawer)
            }
        }
    }

    private fun checkPermissions() {
        var rejectedPermissionList = ArrayList<String>()
        //필요한 퍼미션들을 하나씩 끄집어내서 현재 권한을 받았는지 체크
        for (permission in requiredPermissions) {
            if (ContextCompat.checkSelfPermission(this,
                    permission
                ) != PackageManager.PERMISSION_GRANTED
            ) {
                //만약 권한이 없다면 rejectedPermissionList에 추가
                rejectedPermissionList.add(permission)
            }
        }
        //거절된 퍼미션이 있다면...
        if (rejectedPermissionList.isNotEmpty()) {
            //권한 요청!
            val array = arrayOfNulls<String>(rejectedPermissionList.size)
            ActivityCompat.requestPermissions(this,
                rejectedPermissionList.toArray(array),
                multiplePermissionsCode
            )
        }
    }

    override fun onRequestPermissionsResult(
        requestCode: Int,
        permissions: Array<String>,
        grantResults: IntArray
    ) {
        when (requestCode) {
            multiplePermissionsCode -> {
                if (grantResults.isNotEmpty()) {
                    for ((i, permission) in permissions.withIndex()) {
                        if (grantResults[i] != PackageManager.PERMISSION_GRANTED) {
                            //권한 획득 실패
                        }
                    }
                }
            }
        }
    }

}
