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
    var whichData = arrayOf(true, false, false, false, false, false).toBooleanArray()
    lateinit var dateTimeDialogFragment:SwitchDateTimeDialogFragment
    var whichDate=0
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.dialog_airinfo)

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
        var no = when (view.id) {
            R.id.pm25Check -> 0
            R.id.so2Check -> 1
            R.id.tempCheck -> 2
            R.id.no2Check -> 3
            R.id.o3Check -> 4
            R.id.coCheck -> 5
            else -> 6
        }
        whichData[no] = !whichData[no]
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
                intent.putExtra("WhichData", whichData)
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
