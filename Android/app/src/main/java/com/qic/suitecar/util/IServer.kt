package com.qic.suitecar.util

import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.http.*

interface IServer {
    @POST("signUp")
    @FormUrlEncoded
    fun signUp(
        @Field("device") device :Int,
        @Field("fname") fname : String,
        @Field("lname") lname : String,
        @Field("username") username : String,
        @Field("password") password : String,
        @Field("email") email : String,
        @Field("phone") phone : String
    ): Call<ResponseBody>

    @POST("signIn")
    @FormUrlEncoded
    fun signIn(
        @Field("device") device :Int,
        @Field("username") username : String,
        @Field("password") password : String
    ): Call<ResponseBody>

    @POST("signOut")
    @FormUrlEncoded
    fun signOut(
        @Field("device") device :Int,
        @Field("user_no") user_no :Int
    ): Call<ResponseBody>

    @POST("changePassword")
    @FormUrlEncoded
    fun changePassword(
        @Field("device") device :Int,
        @Field("user_no") user_no :Int,
        @Field("originalPassword") originalPassword : String,
        @Field("newPassword") newPassword : String,
        @Field("confirmPassword") confirmPassword : String
    ): Call<ResponseBody>

    @POST("forgottenPassword")
    @FormUrlEncoded
    fun forgottenPassword(
        @Field("device") device :Int,
        @Field("username") username : String,
        @Field("email") email : String
    ): Call<ResponseBody>

    @POST("idCancellation")
    @FormUrlEncoded
    fun closeAccount(
        @Field("device") device :Int,
        @Field("user_no") user_no :Int,
        @Field("password") password : String
    ): Call<ResponseBody>

    @POST("sensorList")
    @FormUrlEncoded
    fun sensorList(
        @Field("device") device :Int,
        @Field("user_no") user_no :Int
    ): Call<ResponseBody>
}