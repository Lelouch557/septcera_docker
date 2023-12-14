package com.example.asisstant

class repo {
    lateinit var msg :Array<String>
    constructor(){
        msg = arrayOf()
    }

    fun setMsg(mesage: String){
        var nl = msg.toMutableList()
        nl.add(mesage)
        msg = nl.toTypedArray()
    }

    fun getMesage(): Array<String>{
//        var returnValues = msg
//        msg = arrayOf()
        return msg
    }
}