package com.qic.suitecar

import android.app.Activity
import android.content.Context
import android.content.Intent
import android.os.Bundle
import android.speech.RecognizerIntent
import android.util.Log
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.core.app.ActivityCompat.startActivityForResult
import com.qic.suitecar.util.Action
import com.qic.suitecar.util.Constants
import com.qic.suitecar.util.Constants.SPEECH_INPUT_REQ
import com.qic.suitecar.util.Fitting
import com.qic.suitecar.util.TTS
import kotlinx.android.synthetic.main.fragment_monitoring.view.*
import java.util.*

class SuiteManager {
    var activity:MainActivity
    constructor(activity: Activity){
        this.activity=activity as MainActivity
    }
    val REQ_CODE_SPEECH_INPUT = 0
    lateinit var fitting: Fitting
    lateinit var actions: ArrayList<Action>

    fun suite(ia:Double,it:Double,oa:Double,ot:Double){
        fitting= Fitting(activity)
        var it=it.toInt()
        var ot=ot.toInt()
        var ia=ia.toInt()
        var oa=oa.toInt()
        Log.d("FFM","data : "+it+ot+ia+oa)
        actions = fitting.fitting(it,ot ,ia ,oa )
        var actionsString = String()
        for (i in actions.indices) {
            actionsString += (i + 1).toString() + "." + fitting.recommand(actions[i]) + "\n"
        }
        Log.d("SuiteManager",actionsString)
        startVoiceInput(actionsString)

    }
    private fun startVoiceInput(actionList:String) {
        val intent = Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH)
        intent.putExtra(
            RecognizerIntent.EXTRA_LANGUAGE_MODEL,
            RecognizerIntent.LANGUAGE_MODEL_FREE_FORM
        )
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault())
        intent.putExtra(RecognizerIntent.EXTRA_PROMPT, actionList)
        activity.startActivityForResult(intent,SPEECH_INPUT_REQ)

    }
    fun command(s: String) {
        activity.send(fitting.recommandAction(actions[s.toInt()-1]),Constants.SensorType.CAR)
        TTS.speech(fitting.recommand(actions[s.toInt()-1]))

    }

}
