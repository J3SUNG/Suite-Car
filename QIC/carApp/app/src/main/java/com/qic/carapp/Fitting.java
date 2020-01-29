package com.qic.carapp;

import android.content.Context;
import android.widget.Toast;

import static com.qic.carapp.Action.WO;
import static com.qic.carapp.Action.WC;
import static com.qic.carapp.Action.AIC;
import static com.qic.carapp.Action.AIN;
import static com.qic.carapp.Action.AIH;
import static com.qic.carapp.Action.AOC;
import static com.qic.carapp.Action.AON;
import static com.qic.carapp.Action.AOH;

import java.util.ArrayList;


public class Fitting {
    private static final int C = 1;
    private static final int N = 2;
    private static final int H = 3;
    private static final int GOOD = 1;
    private static final int NORMAL = 2;
    private static final int BAD = 3;
    Boolean air[];
    Boolean temp[];
    Boolean result[];
    Context c;

    Fitting(Context c) {
        this.c=c;
        air = new Boolean[8];
        temp = new Boolean[8];
        result = new Boolean[8];
    }



    String recommand(Action action) {
        String result_s = new String();
        switch (action) {
            case WO:
                result_s =  c.getResources().getString(R.string.wo);
                break;
            case WC:
                result_s = c.getResources().getString(R.string.wc);
                break;
            case AIC:
                result_s = c.getResources().getString(R.string.aic);
                break;
            case AIN:
                result_s = c.getResources().getString(R.string.ain);
                break;
            case AIH:
                result_s = c.getResources().getString(R.string.aih);
                break;
            case AOC:
                result_s = c.getResources().getString(R.string.aoc);
                break;
            case AON:
                result_s = c.getResources().getString(R.string.aon);
                break;
            case AOH:
                result_s = c.getResources().getString(R.string.aoh);
                break;
        }

        return result_s;

    }

    ArrayList<Action> fitting(int car_temp_in,
                              int car_temp_out,
                              int car_air_in,
                              int car_air_out) {
        //TODO:실측값으로 변경
        if (car_air_in == GOOD) {    // 차량 안 공기 맑음
            if (car_air_out == GOOD) {
                for (int i = 0; i < 8; ++i) {    // 모든 경우 다 가능
                    air[i] = true;
                }
            } else {
                air[WC.ordinal()] = true;
                air[AIH.ordinal()] = true;
                air[AIN.ordinal()] = true;
                air[AIC.ordinal()] = true;
            }
        } else if (car_air_in == NORMAL) {    // 차량 안 공기 보통
            if (car_air_out == GOOD) {    // 차량 밖 공기 맑음
                air[WO.ordinal()] = true;    // 창문 열기
                air[AIH.ordinal()] = true;        // 내부 순환
                air[AIN.ordinal()] = true;
                air[AIC.ordinal()] = true;
                air[AOH.ordinal()] = true;    // 외부 순환
                air[AON.ordinal()] = true;
                air[AOC.ordinal()] = true;
            } else {                    // 차량 밖 공기 보통, 나쁨
                air[WC.ordinal()] = true;    // 창문 닫기
                air[AIH.ordinal()] = true;        // 내부 순환
                air[AIN.ordinal()] = true;
                air[AIC.ordinal()] = true;
            }
        } else if (car_air_in == BAD) { // 차량 안 공기 나쁨
            if (car_air_out == GOOD || car_air_out == NORMAL) {    // 차량 밖 공기 좋음, 보통
                air[WO.ordinal()] = true;    // 창문 열기
                air[AIH.ordinal()] = true;        // 내부 순환
                air[AIN.ordinal()] = true;
                air[AIC.ordinal()] = true;
                air[AOH.ordinal()] = true;    // 외부 순환
                air[AON.ordinal()] = true;
                air[AOC.ordinal()] = true;
            } else {                    // 차량 밖 공기 나쁨
                air[WC.ordinal()] = true;    // 창문 닫기
                air[AIH.ordinal()] = true;        // 내부 순환
                air[AIN.ordinal()] = true;
                air[AIC.ordinal()] = true;
            }
        }

        if (car_temp_in == H) {    // 차량 내부 온도 높음
            if (car_temp_out == H) {    // 차량 외부 온도 높음
                temp[AIN.ordinal()] = true;     // 내부 순환 보통, 차가움
                temp[AIC.ordinal()] = true;
                temp[AON.ordinal()] = true; // 외부 순환 보통, 차가움
                temp[AOC.ordinal()] = true;
            } else {                    // 차량 외부 온도 보통, 낮음
                temp[WO.ordinal()] = true;    // 내부 순환 보통, 차가움
                temp[AIN.ordinal()] = true;
                temp[AIC.ordinal()] = true;
                temp[AON.ordinal()] = true; // 외부 순환 보통, 차가움
                temp[AOC.ordinal()] = true;
            }
        } else if (car_temp_in == N) {    // 내부온도 보통
            if (car_temp_out == N) {    // 외부온도 보통
                for (int i = 0; i < 8; ++i) {    // 모든 경우 가능
                    temp[i] = true;
                }
            } else {    // 외부온도 추움, 더움
                temp[WC.ordinal()] = true;    // 창문 닫기
                temp[AIN.ordinal()] = true;    // 온도 유지, 청정
                temp[AON.ordinal()] = true;
            }
        } else {    // 내부온도 추움
            if (car_temp_out == C) {    // 외부온도 추움
                temp[WC.ordinal()] = true;    // 창문 닫기
                temp[AIN.ordinal()] = true;    // 내부순환 보통, 더움
                temp[AIH.ordinal()] = true;
                temp[AON.ordinal()] = true;// 외부순환 보통, 더움
                temp[AOH.ordinal()] = true;
            } else {    //외부온도 보통, 더움
                temp[WO.ordinal()] = true;    // 창문 열기
                temp[AIN.ordinal()] = true;    // 내부순환 보통, 더움
                temp[AIH.ordinal()] = true;
                temp[AON.ordinal()] = true;// 외부 순환 보통, 더움
                temp[AOH.ordinal()] = true;
            }
        }
        ArrayList<Action> result = new ArrayList<>();
        for (int i = 0; i < 8; ++i) {
            if (air[i] == temp[i]) {
                result.add(Action.values()[i]);
            }
        }
        return result;
    }
}
