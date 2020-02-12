package com.qic.suitecar

import android.app.Activity
import android.bluetooth.BluetoothAdapter
import android.bluetooth.BluetoothDevice
import android.content.BroadcastReceiver
import android.content.Context
import android.content.Intent
import android.content.IntentFilter
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.util.Log
import android.view.View
import android.view.Window
import android.widget.*
import com.qic.suitecar.util.Constants
import kotlinx.android.synthetic.main.activity_device_list.*

class DeviceListActivity : Activity() {
    /**
     * Tag for Log
     */
    private val TAG = "DeviceListActivity"

    /**
     * Return Intent extra
     */
    var EXTRA_DEVICE_ADDRESS = "device_address"
    var EXTRA_DEVICE_TYPE = "device_type"
    /**
     * Member fields
     */
    private var mBtAdapter: BluetoothAdapter? = null

    /**
     * Newly discovered devices
     */
    private var mNewDevicesArrayAdapter: ArrayAdapter<String>? = null

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_device_list)

        // Set result CANCELED in case the user backs out
        setResult(Activity.RESULT_CANCELED)

        // Initialize the button to perform device discovery
        button_scan.setOnClickListener { v ->
            doDiscovery()
            v.visibility = View.GONE
        }

        // Initialize array adapters. One for already paired devices and
        // one for newly discovered devices
        val pairedDevicesArrayAdapter = ArrayAdapter<String>(this, R.layout.item_device_name)
        mNewDevicesArrayAdapter = ArrayAdapter(this, R.layout.item_device_name)

        // Find and set up the ListView for paired devices
        paired_devices.adapter = pairedDevicesArrayAdapter
        paired_devices.onItemClickListener = mDeviceClickListener

        // Find and set up the ListView for newly discovered devices
        new_devices.adapter = mNewDevicesArrayAdapter
        new_devices.onItemClickListener = mDeviceClickListener

        // Register for broadcasts when a device is discovered
        var filter = IntentFilter(BluetoothDevice.ACTION_FOUND)
        this.registerReceiver(mReceiver, filter)

        // Register for broadcasts when discovery has finished
        filter = IntentFilter(BluetoothAdapter.ACTION_DISCOVERY_FINISHED)
        this.registerReceiver(mReceiver, filter)

        // Get the local Bluetooth adapter
        mBtAdapter = BluetoothAdapter.getDefaultAdapter()

        // Get a set of currently paired devices
        val pairedDevices = mBtAdapter!!.bondedDevices

        // If there are paired devices, add each one to the ArrayAdapter
        if (pairedDevices.size > 0) {
           title_paired_devices.setVisibility(View.VISIBLE)
            for (device in pairedDevices) {
                pairedDevicesArrayAdapter.add(device.name + "\n" + device.address)
            }
        } else {
            val noDevices = "No Paired Device"
            pairedDevicesArrayAdapter.add(noDevices)
        }
    }

    override fun onDestroy() {
        super.onDestroy()

        // Make sure we're not doing discovery anymore
        if (mBtAdapter != null) {
            mBtAdapter!!.cancelDiscovery()
        }

        // Unregister broadcast listeners
        this.unregisterReceiver(mReceiver)
    }

    /**
     * Start device discover with the BluetoothAdapter
     */
    private fun doDiscovery() {
        Log.d(TAG, "doDiscovery()")

        // Indicate scanning in the title
        this.title="Scanning"
        // Turn on sub-title for new devices
        title_new_devices.visibility=View.VISIBLE
        // If we're already discovering, stop it
        if (mBtAdapter!!.isDiscovering) {
            mBtAdapter!!.cancelDiscovery()
        }

        // Request discover from BluetoothAdapter
        mBtAdapter!!.startDiscovery()
    }

    /**
     * The on-click listener for all devices in the ListViews
     */
    private val mDeviceClickListener =
        AdapterView.OnItemClickListener { av, v, arg2, arg3 ->
            // Cancel discovery because it's costly and we're about to connect
            mBtAdapter!!.cancelDiscovery()

            // Get the device MAC address, which is the last 17 chars in the View
            val info = (v as TextView).text.toString()
            val address = info.substring(info.length - 17)

            // Create the result Intent and include the MAC address
            val intent = Intent()
            intent.putExtra(EXTRA_DEVICE_ADDRESS, address)
            intent.putExtra(EXTRA_DEVICE_TYPE,Constants.HEARTSENSER)
            // Set result and finish this Activity
            setResult(Activity.RESULT_OK, intent)
            finish()
        }

    /**
     * The BroadcastReceiver that listens for discovered devices and changes the title when
     * discovery is finished
     */
    private val mReceiver = object : BroadcastReceiver() {
        override fun onReceive(context: Context, intent: Intent) {
            val action = intent.action

            // When discovery finds a device
            if (BluetoothDevice.ACTION_FOUND == action) {
                // Get the BluetoothDevice object from the Intent
                val device =
                    intent.getParcelableExtra<BluetoothDevice>(BluetoothDevice.EXTRA_DEVICE)
                // If it's already paired, skip it, because it's been listed already
                if (device!!.bondState != BluetoothDevice.BOND_BONDED) {
                    mNewDevicesArrayAdapter!!.add(device.name + "\n" + device.address)
                }
                // When discovery is finished, change the Activity title
            } else if (BluetoothAdapter.ACTION_DISCOVERY_FINISHED == action) {
                title="Select Device"
                if (mNewDevicesArrayAdapter!!.count == 0) {
                    val noDevices = "No Device"
                    mNewDevicesArrayAdapter!!.add(noDevices)
                }
            }
        }
    }

}
