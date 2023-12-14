package com.example.asisstant

import android.os.Bundle
import android.view.View
import android.widget.Button
import android.widget.TextView
import androidx.appcompat.app.AppCompatActivity
import androidx.constraintlayout.widget.ConstraintLayout
import androidx.coordinatorlayout.widget.CoordinatorLayout
import com.google.android.material.textfield.TextInputLayout


class MainActivity : AppCompatActivity() {

    lateinit var viewLayout: CoordinatorLayout
    private var r = repo()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        setContentView(R.layout.main_asisstant)
        viewLayout = findViewById<CoordinatorLayout>(R.id.main)
        var ipAdress = findViewById<TextInputLayout>(R.id.ip)
        ipAdress.text =

        val firstButton: Button = findViewById(R.id.firstButton)

        // Set the OnClickListener for the button
        firstButton.setOnClickListener(object : View.OnClickListener {
            override fun onClick(v: View?) {
                val t = Thread(send(r, "Notepad", ipAdress))
                t.start()
            }
        })
        val secondButton: Button = Button(this)

        // Set the OnClickListener for the button
        secondButton.setOnClickListener(object : View.OnClickListener {
            override fun onClick(v: View?) {
                val t = Thread(send(r, "Start Septcera", ipAdress))
                t.start()
            }
        })

    }

    fun showText(){
        var topMargin = 0
        for (item in r.getMesage()){
            val rowTextView = TextView(this);

            rowTextView.text = item
            rowTextView.textSize = 20f

            val params = ConstraintLayout.LayoutParams(
                ConstraintLayout.LayoutParams.WRAP_CONTENT,
                ConstraintLayout.LayoutParams.WRAP_CONTENT
            )
            params.setMargins(0,topMargin,0,0)
            rowTextView.layoutParams = params

            viewLayout.addView(rowTextView)
            topMargin += 50
        }
    }
}