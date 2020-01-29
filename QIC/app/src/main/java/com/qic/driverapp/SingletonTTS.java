package com.qic.driverapp;

import android.content.Context;
import android.speech.tts.TextToSpeech;
import android.util.Log;
import android.widget.Toast;

import java.util.Locale;

public class SingletonTTS {
    private static SingletonTTS instance;
    private static Context ctx;
    private TextToSpeech mTTS;

    private SingletonTTS(Context context) {
        ctx = context;
        mTTS = new TextToSpeech(context, new TextToSpeech.OnInitListener() {
            @Override
            public void onInit(int i) {
                configTTS();
            }
        });
    }

    public static synchronized SingletonTTS getInstance(Context context) {
        if (instance == null) {
            instance = new SingletonTTS(context);
        }
        return instance;
    }
    public void distroy(){
        mTTS.stop();
        mTTS.shutdown();
    }

    private void configTTS() {
        Toast.makeText(ctx, "supports " + mTTS.isLanguageAvailable(Locale.getDefault()), Toast.LENGTH_LONG).show();
        mTTS.setLanguage(new Locale(Locale.getDefault().getLanguage()));
    }

    public void speakSentence(String sentence) {
        Log.d("TTS",mTTS.toString());
        mTTS.speak(sentence, TextToSpeech.QUEUE_ADD, null, null);
    }

}
