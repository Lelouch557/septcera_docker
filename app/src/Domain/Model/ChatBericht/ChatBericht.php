<?php

/*
 * mine -André
 */

namespace App\Domain\Model\ChatBericht;

use App\Domain\Model\Chat\Chat;
use App\Domain\Model\User\User;
use DateTime;
use Ramsey\Uuid\UuidInterface;

class ChatBericht {
    public function __construct(
        private UuidInterface $id,
        private Chat $chat,
        private User $user,
        private string $text,
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
    public function getText(): string {
        return $this->text;
    }
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }
    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }
}
