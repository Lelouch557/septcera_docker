package com.example.asisstant
import androidx.fragment.app.Fragment
import java.net.Socket

/**
 * A simple [Fragment] subclass as the default destination in the navigation.
 */
class send(rep: repo, msg: String, ip: String) : Runnable {
    private var reposi: repo = rep
    private var message: String = msg
    private var ipAdress: String = ip

    override fun run()  {
        val s = Socket(ipAdress, 12346)

        val outPutStream = s.getOutputStream()
        outPutStream.write(message.toByteArray())

        for (item in s.getInputStream().reader().readLines()) {
            if (item != "") {
                reposi.setMsg(item)
            }
        }

    }
}