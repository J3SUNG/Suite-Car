package com.qic.suitecar.ui.login

import android.content.Context
import android.content.Intent
import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.fragment.app.Fragment
import com.google.gson.Gson
import com.qic.suitecar.MainActivity
import com.qic.suitecar.R
import com.qic.suitecar.dataclass.ResultData
import com.qic.suitecar.dataclass.ResultSignInData
import com.qic.suitecar.util.IServer
import com.qic.suitecar.util.RetrofitClient
import kotlinx.android.synthetic.main.fragment_signin.*
import kotlinx.android.synthetic.main.fragment_signin.view.*
import okhttp3.ResponseBody
import org.json.JSONStringer
import retrofit2.Call
import retrofit2.Response

class SignInFragment : Fragment(), View.OnClickListener {
    var username: String? = null
    var password: String? = null
    lateinit var mContext: Context
    override fun onClick(v: View) {
        when (v.id) {
            R.id.signInButton -> {
                mContext = this.context!!
                username = signInUsername.text.toString()
                password = signInPassword.text.toString()
                singIn()

            }
        }

    }

    private fun singIn() {
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)
        if (username.isNullOrEmpty() || password.isNullOrEmpty()) {
            return
        }
        Runnable {
            myApi.signin(1, username!!, password!!).enqueue(object :
                retrofit2.Callback<ResponseBody> {
                override fun onResponse(
                    call: Call<ResponseBody>,
                    response: Response<ResponseBody>
                ) {
                    var a = response.body()!!.string()

                    var gson = Gson()
                    var resultSignInData = gson.fromJson(a, ResultSignInData::class.java)
                    when(resultSignInData.result){
                        0->{
                            Toast.makeText(mContext,"Check your ID or Password",Toast.LENGTH_SHORT).show()
                            return
                        }
                        1->{
                            Toast.makeText(mContext,"Welcome to SuitCar",Toast.LENGTH_SHORT).show()

                        }
                        2->{
                            Toast.makeText(mContext,"You should change the password",Toast.LENGTH_SHORT).show()

                        }
                    }
                    SharedPreValue.setLoginFlag(mContext,true)
                    SharedPreValue.setUserNo(mContext,resultSignInData.user_no)
                    Log.d("SignIn",resultSignInData.user_no.toString()+"asd")
                    SharedPreValue.setUsername(mContext,username!!)
                    var intent = Intent(mContext, MainActivity::class.java)
                    startActivity(intent)
                }
                override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                    Log.d("SignIn", "Fail : " + t.message)
                }

            })
        }.run()
    }


    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val root = inflater.inflate(R.layout.fragment_signin, container, false)
        root.signInButton.setOnClickListener(this)

        return root
    }
}