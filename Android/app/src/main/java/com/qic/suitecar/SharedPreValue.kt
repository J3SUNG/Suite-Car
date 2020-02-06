package com.qic.suitecar.ui.login

import android.content.Context

class SharedPreValue {
    companion object {
        val loginFlag:Boolean=false
        val username:String=""
        val userNo:Int=0

        fun setLoginFlag(ctx: Context, value : Boolean){
            val preferences = ctx.getSharedPreferences("suitCar", Context.MODE_PRIVATE)
            val editor = preferences.edit()
            editor.putBoolean("loginFlag",value)
            editor.commit()
        }

        fun getLoginFlag(ctx: Context) : Boolean{
            val preferences = ctx.getSharedPreferences("suitCar", Context.MODE_PRIVATE)
            return preferences.getBoolean("loginFlag", false)
        }
        fun setUsername(ctx: Context, value : String){
            val preferences = ctx.getSharedPreferences("suitCar", Context.MODE_PRIVATE)
            val editor = preferences.edit()
            editor.putString("username",value)
            editor.commit()
        }

        fun getUsername(ctx: Context) : String{
            val preferences = ctx.getSharedPreferences("suitCar", Context.MODE_PRIVATE)
            return preferences.getString("username","")!!
        }
        fun setUserNo(ctx: Context, value : Int){
            val preferences = ctx.getSharedPreferences("suitCar", Context.MODE_PRIVATE)
            val editor = preferences.edit()
            editor.putInt("userNo",0)
            editor.commit()
        }

        fun getUserNo(ctx: Context) : Int{
            val preferences = ctx.getSharedPreferences("suitCar", Context.MODE_PRIVATE)
            return preferences.getInt("userNo", 0)
        }
        fun AllDataRemove(ctx: Context) {
            val preferences = ctx.getSharedPreferences("suitCar", Context.MODE_PRIVATE)
            val editor = preferences.edit()
            editor.clear()
            editor.commit()
        }


    }
}