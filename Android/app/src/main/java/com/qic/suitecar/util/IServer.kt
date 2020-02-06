package com.qic.suitecar.util

import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.http.*

interface IServer {
    @POST("signIn")
    @FormUrlEncoded
    fun signIn(
        @Field("device") device :Int,
        @Field("username") username : String,
        @Field("password") password : String
    ): Call<ResponseBody>
    @POST("changePassword")
    @FormUrlEncoded
    fun changePassword(
        @Field("device") device :Int,
        @Field("originalPassword") originalPassword : String,
        @Field("newPassword") newPassword : String,
        @Field("confirmPassword") passwordConfirm : String
    ): Call<ResponseBody>
}