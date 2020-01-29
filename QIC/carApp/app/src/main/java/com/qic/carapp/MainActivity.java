package com.qic.carapp;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import android.Manifest;
import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.os.Bundle;
import android.speech.RecognizerIntent;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Locale;

public class MainActivity extends AppCompatActivity {
    private static final int REQ_CODE_SPEECH_INPUT = 0;
    private static final int REQUEST_MICROPHONE = 1;
    private static final int REQUEST_INTERNET = 2;
    SingletonTTS mTTS;
    ArrayList<Action> actions;
    TextView resultTV;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        requestPermissions();
        mTTS=SingletonTTS.getInstance(this.getBaseContext());
        Fitting fitting = new Fitting(this);
        actions=fitting.fitting(1,2,1,3);
        String actions_string= new String();
        for(int i=0;i<actions.size();i++){
            actions_string+=(i+1)+"." + fitting.recommand(actions.get(i))+"\n";
        }
        resultTV=findViewById(R.id.resultTextView);
        resultTV.setText(actions_string);
    }

    private void requestPermissions() {
        if (ContextCompat.checkSelfPermission(this,
                Manifest.permission.RECORD_AUDIO) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this,
                    new String[]{Manifest.permission.RECORD_AUDIO}, REQUEST_MICROPHONE);

        }
        if (ContextCompat.checkSelfPermission(this,
                Manifest.permission.INTERNET) !=PackageManager.PERMISSION_GRANTED){
                ActivityCompat.requestPermissions(this,
                        new String[]{Manifest.permission.RECORD_AUDIO}, REQUEST_INTERNET);
            }
        }

    public void onClick(View view) {
        switch (view.getId()){
            case R.id.inputVoiceButton: {
                startVoiceInput();
                break;
            }
            case R.id.readResultButton:{
                mTTS.speakSentence(resultTV.getText().toString());
            }
        }
    }

    private void openWindow() {
        mTTS.speakSentence("open the window");
    }
    private void closeWindow(){
        mTTS.speakSentence("close the window");
    }
    private void turnOnAircon(){
        mTTS.speakSentence("turn on the air conditioner");
    }
    private void turnOffAircon(){
        mTTS.speakSentence("turn off the air conditioner");
    }

    @Override
    protected void onDestroy() {
        super.onDestroy();
        mTTS.distroy();
    }

    private void startVoiceInput() {
        Intent intent = new Intent(RecognizerIntent.ACTION_RECOGNIZE_SPEECH);
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE_MODEL, RecognizerIntent.LANGUAGE_MODEL_FREE_FORM);
        intent.putExtra(RecognizerIntent.EXTRA_LANGUAGE, Locale.getDefault());
        intent.putExtra(RecognizerIntent.EXTRA_PROMPT, "which do you want to choose?");
        try {
            startActivityForResult(intent, REQ_CODE_SPEECH_INPUT);
        } catch (ActivityNotFoundException a) {

        }
    }
    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        super.onActivityResult(requestCode, resultCode, data);

        switch (requestCode) {
            case REQ_CODE_SPEECH_INPUT: {
                if (resultCode == RESULT_OK && null != data) {
                    ArrayList<String> result = data.getStringArrayListExtra(RecognizerIntent.EXTRA_RESULTS);
                    command(result.get(0));
                    Toast.makeText(this,result.get(0),Toast.LENGTH_LONG).show();
                }
                break;
            }

        }
    }

    private void command(String s) {
        switch(s){
            case "1":
            {
                openWindow();
                break;
            }
            case "2":
            {
                closeWindow();
                break;
            }
            case "3":
            {
                turnOnAircon();
                break;
            }
            case "4":
            {
                turnOffAircon();
                break;
            }
        }
    }
}
