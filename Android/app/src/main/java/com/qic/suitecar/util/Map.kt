package com.qic.suitecar.util

import android.Manifest
import android.content.Context
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Bitmap
import android.graphics.Canvas
import android.os.Bundle
import android.os.Looper
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import androidx.core.content.ContextCompat.startActivity
import com.google.android.gms.location.*
import com.google.android.gms.maps.CameraUpdateFactory
import com.google.android.gms.maps.GoogleMap
import com.google.android.gms.maps.OnMapReadyCallback
import com.google.android.gms.maps.SupportMapFragment
import com.google.android.gms.maps.model.*
import com.qic.suitecar.R
import com.qic.suitecar.ui.airinfo.AirInfoActivity

class Map : OnMapReadyCallback {
    var mMap: GoogleMap? = null
    lateinit var fusedLocationClient: FusedLocationProviderClient   //위치정보 가져오는 인스턴스
    lateinit var locationCallback: LocationCallback
    lateinit var locationRequest: LocationRequest
    var prev_loc: LatLng = LatLng(0.0, 0.0)          //이전위치
    lateinit var cur_loc: LatLng            //현재위치
    var userMaker: Marker? = null        //사용자 마커
    lateinit var userIcon: BitmapDescriptor    //사용자 이미지 아이콘(마커에 들어가는 이미지)
    val context:Context
    private val multiplePermissionsCode = 100          //권한
    private val requiredPermissions = arrayOf(
        Manifest.permission.ACCESS_FINE_LOCATION,
        Manifest.permission.ACCESS_COARSE_LOCATION,
        Manifest.permission.ACCESS_BACKGROUND_LOCATION,
        Manifest.permission.READ_EXTERNAL_STORAGE
    )
    
    override fun onMapReady(p0: GoogleMap?) {
        Log.d("Map", "Map is ready" + p0)
        mMap = p0
        fusedLocationClient.requestLocationUpdates(                     //위치정보 요청
            locationRequest,
            locationCallback,
            Looper.myLooper()
        )
    }
    constructor(smf:SupportMapFragment,context:Context){
        this.context=context
        smf.getMapAsync(this)
        init()
    }

    private fun init() {
        userIcon = makingIcon(R.drawable.ic_maker_marker, context)

        fusedLocationClient = LocationServices.getFusedLocationProviderClient(context)
        fusedLocationClient.lastLocation        //가기의 마지막위치 가져오기(초기위치설정)
            .addOnSuccessListener { location ->
                if (location == null) {
                } else {
                    prev_loc = LatLng(location.latitude, location.longitude)    //초기위치 저장
                    val markerOptions = MarkerOptions()
                    markerOptions.position(prev_loc)
                    markerOptions.title("Me")
                    markerOptions.icon(userIcon)
                    userMaker = mMap?.addMarker(markerOptions)       //현재위치에 marker를 그림
                }
            }
            .addOnFailureListener {
                it.printStackTrace()
            }

        locationRequest = LocationRequest.create()                  //위치 추적 요청 생성
        locationRequest.run {
            //1초간격, 높은정확도로 요청
            priority = LocationRequest.PRIORITY_HIGH_ACCURACY
            interval = 1000
        }

        locationCallback = object : LocationCallback() {        //위치요청 결과가 들어오면 실행되는 코드
            override fun onLocationResult(locationResult: LocationResult?) {
                locationResult?.let {
                    for ((i, location) in it.locations.withIndex()) {
                        var lat = location.latitude     //결과로 가져온 location에서 정보추출
                        var lng = location.longitude
                        var alt = location.altitude
                        var speed = location.speed
                        cur_loc = LatLng(lat, lng)             //새로받은 정보로 현재위치 설정

                        if (userMaker != null) userMaker!!.remove()     //이미 그려진 마커가 있으면 지우고 재생성
                        val markerOptions = MarkerOptions()
                        markerOptions.position(cur_loc)
                        markerOptions.title("Me")
                        markerOptions.icon(userIcon)

                        userMaker = mMap?.addMarker(markerOptions)
                        mMap!!.setOnMarkerClickListener {
                            var intent = Intent(context, AirInfoActivity::class.java)
                            intent.putExtra("Title", it.title)
                            startActivity(context,intent,null)
                            true
                        }

                        mMap?.moveCamera(
                            CameraUpdateFactory.newLatLngZoom(
                                cur_loc,
                                17F
                            )
                        )        //현재위치 따라서 카메라 이동
                    }
                }
            }
        }

    }

    fun makingIcon(drawable: Int, context: Context): BitmapDescriptor {
        // 기본 마커 활용해서
        val circleDrawable = context.getDrawable(drawable)
        var canvas = Canvas()
        var bitmap = Bitmap.createBitmap(
            circleDrawable!!.intrinsicWidth,
            circleDrawable!!.intrinsicHeight,
            Bitmap.Config.ARGB_8888
        )
        canvas.setBitmap(bitmap);
        circleDrawable.setBounds(
            0,
            0,
            circleDrawable.intrinsicWidth,
            circleDrawable.intrinsicHeight
        )
        circleDrawable.draw(canvas)
        return BitmapDescriptorFactory.fromBitmap(bitmap)
    }


}