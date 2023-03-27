package com.example.iabamun
import kotlinx.serialization.SerialName
import kotlinx.serialization.Serializable

@Serializable
data class GetChatMessages(
    @SerialName("user")
    val userId: String,
    @SerialName("text")
    val text: String,
    @SerialName("created_at")
    val createdAt: String,
    @SerialName("updated_at")
    val updatedAt: Boolean
)
