package com.qic.suitecar.ui.login

import android.content.Intent
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.TextView
import androidx.fragment.app.Fragment
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProviders
import com.qic.suitecar.MainActivity
import com.qic.suitecar.R
import kotlinx.android.synthetic.main.fragment_signin.view.*

class SignInFragment : Fragment(),View.OnClickListener {
    override fun onClick(v: View) {
        when(v.id){
            R.id.signInButton->{
                var intent = Intent(this.activity, MainActivity::class.java)
                startActivity(intent)
            }
        }

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