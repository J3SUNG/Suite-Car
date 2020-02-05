package com.qic.suitecar.util

import android.content.Context
import com.qic.suitecar.R
import com.qic.suitecar.util.Action.*
import java.util.ArrayList

class Fitting {
    val C = 1
    val N = 2
    val H = 3
    val GOOD = 1
    val NORMAL = 2
    val BAD = 3
    var air = arrayOfNulls<Boolean>(8)
    var temp = arrayOfNulls<Boolean>(8)
    var result = arrayOfNulls<Boolean>(8)
    var context: Context

    constructor(c: Context) {
        this.context = c
    }

    fun recommand(action: Action): String {
        return when (action) {
            WO ->  context.getResources().getString(R.string.wo)
            WC -> context.getResources().getString(R.string.wc)
            AIC ->  context.getResources().getString(R.string.aic)
            AIN ->  context.getResources().getString(R.string.ain)
            AIH ->  context.getResources().getString(R.string.aih)
            AOC ->  context.getResources().getString(R.string.aoc)
            AON ->  context.getResources().getString(R.string.aon)
            AOH ->  context.getResources().getString(R.string.aoh)
        }
    }

    fun fitting(
        car_temp_in: Int,
        car_temp_out: Int,
        car_air_in: Int,
        car_air_out: Int
    ): ArrayList<Action> {
        //TODO:실측값으로 변경
        if (car_air_in == GOOD) {    // 차량 안 공기 맑음
            if (car_air_out == GOOD) {
                for (i in 0..7) {    // 모든 경우 다 가능
                    air[i] = true
                }
            } else {
                air[WC.ordinal] = true
                air[AIH.ordinal] = true
                air[AIN.ordinal] = true
                air[AIC.ordinal] = true
            }
        } else if (car_air_in == NORMAL) {    // 차량 안 공기 보통
            if (car_air_out == GOOD) {    // 차량 밖 공기 맑음
                air[WO.ordinal] = true    // 창문 열기
                air[AIH.ordinal] = true        // 내부 순환
                air[AIN.ordinal] = true
                air[AIC.ordinal] = true
                air[AOH.ordinal] = true    // 외부 순환
                air[AON.ordinal] = true
                air[AOC.ordinal] = true
            } else {                    // 차량 밖 공기 보통, 나쁨
                air[WC.ordinal] = true    // 창문 닫기
                air[AIH.ordinal] = true        // 내부 순환
                air[AIN.ordinal] = true
                air[AIC.ordinal] = true
            }
        } else if (car_air_in == BAD) { // 차량 안 공기 나쁨
            if (car_air_out == GOOD || car_air_out == NORMAL) {    // 차량 밖 공기 좋음, 보통
                air[WO.ordinal] = true    // 창문 열기
                air[AIH.ordinal] = true        // 내부 순환
                air[AIN.ordinal] = true
                air[AIC.ordinal] = true
                air[AOH.ordinal] = true    // 외부 순환
                air[AON.ordinal] = true
                air[AOC.ordinal] = true
            } else {                    // 차량 밖 공기 나쁨
                air[WC.ordinal] = true    // 창문 닫기
                air[AIH.ordinal] = true        // 내부 순환
                air[AIN.ordinal] = true
                air[AIC.ordinal] = true
            }
        }

        if (car_temp_in == H) {    // 차량 내부 온도 높음
            if (car_temp_out == H) {    // 차량 외부 온도 높음
                temp[AIN.ordinal] = true     // 내부 순환 보통, 차가움
                temp[AIC.ordinal] = true
                temp[AON.ordinal] = true // 외부 순환 보통, 차가움
                temp[AOC.ordinal] = true
            } else {                    // 차량 외부 온도 보통, 낮음
                temp[WO.ordinal] = true    // 내부 순환 보통, 차가움
                temp[AIN.ordinal] = true
                temp[AIC.ordinal] = true
                temp[AON.ordinal] = true // 외부 순환 보통, 차가움
                temp[AOC.ordinal] = true
            }
        } else if (car_temp_in == N) {    // 내부온도 보통
            if (car_temp_out == N) {    // 외부온도 보통
                for (i in 0..7) {    // 모든 경우 가능
                    temp[i] = true
                }
            } else {    // 외부온도 추움, 더움
                temp[WC.ordinal] = true    // 창문 닫기
                temp[AIN.ordinal] = true    // 온도 유지, 청정
                temp[AON.ordinal] = true
            }
        } else {    // 내부온도 추움
            if (car_temp_out == C) {    // 외부온도 추움
                temp[WC.ordinal] = true    // 창문 닫기
                temp[AIN.ordinal] = true    // 내부순환 보통, 더움
                temp[AIH.ordinal] = true
                temp[AON.ordinal] = true// 외부순환 보통, 더움
                temp[AOH.ordinal] = true
            } else {    //외부온도 보통, 더움
                temp[WO.ordinal] = true    // 창문 열기
                temp[AIN.ordinal] = true    // 내부순환 보통, 더움
                temp[AIH.ordinal] = true
                temp[AON.ordinal] = true// 외부 순환 보통, 더움
                temp[AOH.ordinal] = true
            }
        }
        val result = ArrayList<Action>()
        for (i in 0..7) {
            if (air[i] === temp[i]) {
                result.add(values()[i])
            }
        }
        return result
    }
}