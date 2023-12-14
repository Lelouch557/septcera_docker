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

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function setChat(Chat $chat): void {
        $this->chat = $chat;
    }

    public function setUser(User $user): void {
        $this->user = $user;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
