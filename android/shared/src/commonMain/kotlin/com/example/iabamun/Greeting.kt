package com.example.iabamun
import io.ktor.client.*
import io.ktor.client.call.*
import io.ktor.client.plugins.contentnegotiation.*
import io.ktor.client.request.*
import io.ktor.serialization.kotlinx.json.*
import kotlinx.serialization.json.Json

class Greeting {
    private val platform: Platform = getPlatform()

    private val httpClient = HttpClient {
        install(ContentNegotiation) {
            json(Json {
                prettyPrint = true
                isLenient = true
                ignoreUnknownKeys = true
            })
        }
    }

    @Throws(Exception::class)
    suspend fun greeting(): String {
        val messages: List<ChatMessages> =
            httpClient.get("192.168.2.9/").body()

        var text = "dfgh"
//        for(item in messages){
//            text += " - " + item.text + " "
//        }

        return text
    }

    fun greet(): String {
        return "Hello, ${platform.name}!"
    }
}