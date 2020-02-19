package com.qic.suitecar.ui.monitoring

import android.app.Activity.RESULT_OK
import android.content.Intent
import android.os.Bundle
import android.speech.RecognizerIntent
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.fragment.app.Fragment
import com.qic.suitecar.util.Action
import com.qic.suitecar.util.Fitting
import com.qic.suitecar.R
import com.qic.suitecar.util.TTS
import kotlinx.android.synthetic.main.fragment_monitoring.view.*
import java.util.*

class MonitoringFragment : Fragment(), View.OnClickListener {
    val REQ_CODE_SPEECH_INPUT = 0
    override fun onClick(v: View) {
        when (v.id) {
            R.id.inputVoiceButton -> {
                startVoiceInput()
            }
            R.id.readResultButton -> {
                TTS.speech(root.resultTextView.text.toString())
            }
            R.id.fitformeButton->{
                fitforme()
            }

        }
    }

    lateinit var fitting: Fitting
    lateinit var root: View
    lateinit var actions: ArrayList<Action>
    override fun onCreateView(
        inflater: LayoutInflater,
        container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {

        val root = inflater.inflate(R.layout.fragment_monitoring, container, false)
        this.root = root

        root.fitformeButton.setOnClickListener(this)
        root.inputVoiceButton.setOnClickListener(this)
        root.readResultButton.setOnClickListener(this)
        return root
    }
    private fun fitforme(){
        fitting= Fitting(context!!)
        var it=root.editCIT.text.toString().toInt()
        var ot=root.editCOT.text.toString().toInt()
        var ia=root.editCIA.text.toString().toInt()
        var oa=root.editCOA.text.toString().toInt()
        Log.d("FFM","data : "+it+ot+ia+oa)
        actions = fitting.fitting(it,ot ,ia ,oa )
        var actions_string = String()
        for (i in actions.indices) {
            actions_string += (i + 1).toString() + "." + fitting.recommand(actions[i]) + "\n"
        }
        root.resultTextView.text = actions_string

    }
    private fun startVoiceInput() {
        val intent = Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH)
        intent.putExtra(
            RecognizerIntent.EXTRA_LANGUAGE_MODEL,
            RecognizerIntent.LANGUAGE_MODEL_FREE_FORM
        )
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault())
        intent.putExtra(RecognizerIntent.EXTRA_PROMPT, "which do you want to choose?")
        startActivityForResult(intent, REQ_CODE_SPEECH_INPUT)


    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)

        when (requestCode) {
            REQ_CODE_SPEECH_INPUT -> {
                if (resultCode == RESULT_OK && null != data) {
                    val result = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS)
                    TTS.speech(fitting.recommand(actions[result!![0].toInt()-1]))
                    Toast.makeText(context, result!![0], Toast.LENGTH_LONG).show()
                }
            }
        }
    }

    private fun openWindow() {
        TTS.speech("open the window")
    }

    private fun closeWindow() {
        TTS.speech("close the window")
    }

    private fun turnOnAircon() {
        TTS.speech("turn on the air conditioner")
    }

    private fun turnOffAircon() {
        TTS.speech("turn off the air conditioner")
    }

    private fun command(s: String) {
        when (s) {
            "1" -> {
                openWindow()
            }
            "2" -> {
                closeWindow()
            }
            "3" -> {
                turnOnAircon()
            }
            "4" -> {
                turnOffAircon()
            }
        }
    }
}