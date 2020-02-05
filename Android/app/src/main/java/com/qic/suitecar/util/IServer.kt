package com.qic.suitecar.util

import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.http.*

interface IServer {
    @POST("signIn")
    @FormUrlEncoded
    fun signIn(
        @Field("deivce") device :Int,
        @Field("username") username : String,
        @Field("password") password : String
    ): Call<ResponseBody>

}