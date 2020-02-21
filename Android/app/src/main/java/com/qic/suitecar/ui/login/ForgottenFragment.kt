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
import kotlinx.android.synthetic.main.fragment_forgotten.*
import kotlinx.android.synthetic.main.fragment_forgotten.view.*
import kotlinx.android.synthetic.main.fragment_signup.*
import okhttp3.ResponseBody
import retrofit2.Call
import retrofit2.Response

class ForgottenFragment : Fragment() {
    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val root = inflater.inflate(R.layout.fragment_forgotten, container, false)
        root.forgottenButton.setOnClickListener{
            var retrofit = RetrofitClient.getInstnace()
            var myApi = retrofit.create(IServer::class.java)
            val username=root.forgottenUsername.text.toString()
            val email=root.forgottenEmail.text.toString()
            Runnable {
                myApi.forgottenPassword(1,username,email)
                    .enqueue(object :
                        retrofit2.Callback<ResponseBody> {
                        override fun onResponse(
                            call: Call<ResponseBody>,
                            response: Response<ResponseBody>
                        ) {
                            (activity as LogInActivity).logInTabLayout.getTabAt(1)!!.select()
                            var a=response.body()!!.string()
                            Toast.makeText(context,a, Toast.LENGTH_SHORT).show()
                        }
                        override fun onFailure(call: Call<ResponseBody>, t: Throwable) {
                            Log.d("forgotten password",t.message)
                        }
                    })
            }.run()
        }
        return root
    }
}