package com.qic.suitecar.util

import com.google.gson.GsonBuilder
import retrofit2.Retrofit
import retrofit2.converter.gson.GsonConverterFactory
import okhttp3.OkHttpClient



object RetrofitClient {
    private var instance : Retrofit? = null
    private val gson = GsonBuilder().setLenient().create()
    fun getInstnace() : Retrofit {
        if(instance == null){
            instance = Retrofit.Builder()
                .baseUrl("http://teamc-iot.calit2.net/")
                //.baseUrl("http://192.168.33.99")
                .addConverterFactory(GsonConverterFactory.create())
                .build()
        }
        return instance!!
    }
}