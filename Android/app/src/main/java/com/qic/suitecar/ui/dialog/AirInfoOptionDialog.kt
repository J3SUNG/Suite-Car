package com.qic.suitecar.ui.dialog

import android.app.Activity
import android.content.Intent
import android.os.Bundle
import android.util.Log
import android.view.View
import androidx.appcompat.app.AppCompatActivity
import com.google.android.gms.dynamic.SupportFragmentWrapper
import com.google.gson.Gson
import com.qic.suitecar.R
import com.qic.suitecar.ui.login.SharedPreValue
import com.qic.suitecar.util.Constants
import com.qic.suitecar.util.Constants.CANCEL
import com.qic.suitecar.util.Constants.EXTRA_DEVICE_ADDRESS
import com.qic.suitecar.util.Constants.OKAY
import kotlinx.android.synthetic.main.dialog_airinfo.*
import com.kunzisoft.switchdatetime.SwitchDateTimeDialogFragment
import java.text.SimpleDateFormat
import java.util.*


class AirInfoOptionDialog : AppCompatActivity() {

    private val TAG = "AirInfoOptionDialog"
    lateinit var whichData:BooleanArray
    lateinit var dateTimeDialogFragment:SwitchDateTimeDialogFragment
    var whichDate=0
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.dialog_airinfo)
        whichData=intent.getBooleanArrayExtra("WhichData")
        coCheck.isChecked=whichData[0]
        so2Check.isChecked=whichData[1]
        no2Check.isChecked=whichData[2]
        o3Check.isChecked=whichData[3]
        pm25Check.isChecked=whichData[4]
        // Initialize
        dateTimeDialogFragment = SwitchDateTimeDialogFragment.newInstance(
            "Date",
            "OK",
            "Cancel"
        )

        // Assign values
        dateTimeDialogFragment.startAtCalendarView()
        dateTimeDialogFragment.set24HoursMode(true)
        dateTimeDialogFragment.minimumDateTime =
            GregorianCalendar(2015, Calendar.JANUARY, 1).getTime()
        dateTimeDialogFragment.maximumDateTime =
            GregorianCalendar(2025, Calendar.DECEMBER, 31).getTime()
        dateTimeDialogFragment.setDefaultDateTime(
            GregorianCalendar(
                2017,
                Calendar.MARCH,
                4,
                15,
                20
            ).getTime()
        )

// Define new day and month format
        try {
            dateTimeDialogFragment.simpleDateMonthAndDayFormat =
                SimpleDateFormat("dd MMMM", Locale.getDefault())
        } catch (e: SwitchDateTimeDialogFragment.SimpleDateMonthAndDayFormatException) {
            Log.e(TAG, e.message)
        }


// Set listener
        dateTimeDialogFragment.setOnButtonClickListener(object :
            SwitchDateTimeDialogFragment.OnButtonClickListener {
            override fun onPositiveButtonClick(date: Date) {
                val format = SimpleDateFormat("YY-MM-dd hh:mm:ss")
                if(whichDate==0){
                    startDate.text=format.format(date)
                }else{
                    endDate.text=format.format(date)
                }
            }

            override fun onNegativeButtonClick(date: Date) {
                Log.d("date",date.toString())
            }
        })




    }

    fun onCheck(view: View) {
        when (view.id) {
            R.id.coCheck -> whichData[0]=coCheck.isChecked
            R.id.so2Check -> whichData[1]=coCheck.isChecked
            R.id.no2Check -> whichData[2]=coCheck.isChecked
            R.id.o3Check -> whichData[3]=coCheck.isChecked
            R.id.pm25Check -> whichData[4]=coCheck.isChecked
        }

    }

    fun onClick(view: View) {
        when (view.id) {
            R.id.startDate->{
                whichDate=0
                dateTimeDialogFragment.show(supportFragmentManager, "dialog_time")
            }
            R.id.endDate->{
                whichDate=1
                dateTimeDialogFragment.show(supportFragmentManager, "dialog_time")
            }

            R.id.airInfoOptionSubmit -> {
                var intent = Intent()
                intent.putExtra(
                    "ViewType",
                    viewTypeGroup.indexOfChild(findViewById(viewTypeGroup.checkedRadioButtonId))
                )
                Log.d("ViewType",viewTypeGroup.indexOfChild(findViewById(viewTypeGroup.checkedRadioButtonId)).toString())
                intent.putExtra("WhichData", whichData)
                Log.d("whichData",whichData[0].toString()+whichData[1].toString()+whichData[2].toString()+whichData[3].toString()+whichData[4].toString())
                intent.putExtra("StartDate",startDate.text)
                intent.putExtra("EndDate",endDate.text)
                setResult(OKAY,intent)
                finish()
            }
            R.id.airInfoOptionCancel -> {
                setResult(CANCEL)
                finish()
            }
        }
    }
}
