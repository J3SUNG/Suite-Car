package com.qic.suitecar.ui.login

import android.os.Bundle
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import android.widget.Toast
import androidx.fragment.app.Fragment
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProviders
import com.qic.suitecar.R
import com.qic.suitecar.util.IServer
import com.qic.suitecar.util.RetrofitClient
import kotlinx.android.synthetic.main.activity_login.*
import kotlinx.android.synthetic.main.fragment_signup.*
import kotlinx.android.synthetic.main.fragment_signup.view.*
import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.Response

class SignUpFragment : Fragment() {

    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val root = inflater.inflate(R.layout.fragment_signup, container, false)

        root.signUpButton.setOnClickListener {
            signUp()
        }
        return root
    }

    private fun signUp() {
        var retrofit = RetrofitClient.getInstnace()
        var myApi = retrofit.create(IServer::class.java)
        val fname=signUpFname.text.toString()
        val lname=signUpLname.text.toString()
        val username=signUpUsername.text.toString()
        val password=signUpPassword.text.toString()
        val email=signUpEmail.text.toString()
        val phone=signUpPhone.text.toString()
        Runnable {
            myApi.signUp(1,fname,lname,username,password,email,phone)
                .enqueue(object :
                    retrofit2.Callback<ResponseBody> {
                    override fun onResponse(
                        call: Call<ResponseBody>,
                        response: Response<ResponseBody>
                    ) {
                        (activity as LogInActivity).logInTabLayout.getTabAt(1)!!.select()
                        Toast.makeText(context,"Success to Sign up. Please Sign i-n",Toast.LENGTH_SHORT).show()
                    }

                    override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                        Log.d("Sign Up",t.message)
                    }
                })
        }.run()
    }
}