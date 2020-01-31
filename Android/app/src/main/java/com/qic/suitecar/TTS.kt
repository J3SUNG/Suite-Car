package com.qic.suitecar

import android.content.Context
import android.speech.tts.TextToSpeech
import android.util.Log
import android.widget.Toast
import java.util.*

class TTS {
    companion object {
        lateinit var textToSpeech: TextToSpeech
        fun set(context: Context) {
            textToSpeech = TextToSpeech(context, TextToSpeech.OnInitListener() {
                @Override
                fun onInit(status: Int) {
                    if (status === TextToSpeech.SUCCESS) {
                        //사용할 언어를 설정
                        val result = textToSpeech.setLanguage(Locale.ENGLISH)
                        //언어 데이터가 없거나 혹은 언어가 지원하지 않으면...
                        if (result == TextToSpeech.LANG_MISSING_DATA || result == TextToSpeech.LANG_NOT_SUPPORTED) {
                            Toast.makeText(context, "이 언어는 지원하지 않습니다.", Toast.LENGTH_SHORT)
                                .show()
                        } else {
                            //음성 톤
                            textToSpeech.setPitch(0.7f)
                            //읽는 속도
                            textToSpeech.setSpeechRate(1.2f)
                        }
                    }
                }
            })
        }
        fun speech(sentence: String) {
            textToSpeech.speak(sentence, TextToSpeech.QUEUE_FLUSH, null, null);
            Log.d("TTS", sentence)
        }
    }
}