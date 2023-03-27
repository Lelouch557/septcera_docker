<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\ChatUser;

use Ramsey\Uuid\UuidInterface;

final class CreateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly UuidInterface $userId,
        private readonly UuidInterface $chatId
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }
    public function getUserId(): UuidInterface {
        return $this->userId;
    }
    public function getChatId(): UuidInterface {
        return $this->chatId;
    }
}
