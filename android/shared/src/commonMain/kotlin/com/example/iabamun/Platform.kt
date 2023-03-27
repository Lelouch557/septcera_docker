package com.example.iabamun

interface Platform {
    val name: String
}

expect fun getPlatform(): Platform