<?php

/*
 * mine -André
 */

namespace App\Domain\Model\ChatUser;

use App\Domain\Model\Chat\Chat;
use App\Domain\Model\User\User;
use Ramsey\Uuid\UuidInterface;

class ChatUser {
    public function __construct(
        private UuidInterface $id,
        private Chat $chat,
        private User $user,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getChat(): Chat {
        return $this->chat;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getCreatedAt(): void {
        $this->createdAt = $this->createdAt;
    }

    public function getUpdatedAt(): void {
        $this->updatedAt = $this->updatedAt;
    }
}
