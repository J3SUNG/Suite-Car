package com.qic.suitecar.util

object Constants {
    // Message types sent from the BluetoothChatService Handler
    val MESSAGE_STATE_CHANGE = 1
    val MESSAGE_READ = 2
    val MESSAGE_WRITE = 3
    val MESSAGE_DEVICE_NAME = 4
    val MESSAGE_TOAST = 5

    // Constants that indicate the current connection state
    val STATE_NONE = 0       // we're doing nothing
    val STATE_LISTEN = 1     // now listening for incoming connections
    val STATE_CONNECTING = 2 // now initiating an outgoing connection
    val STATE_CONNECTED = 3  // now connected to a remote device

    // Key names received from the BluetoothChatService Handler
    val DEVICE_NAME = "device_name"
    val TOAST = "toast"

    val HEARTSENSER=0
    val INAIRSENSER=1
    val OUTAIRSENSER=2

    val WEB=0
    val ANDROID=1
}