<?php

/*
 * This file is Copyrig
 */

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Output\Chat;

use App\Domain\Model\Chat\Chat;

final class ChatOutputDTO implements \JsonSerializable {
    public function __construct(
        private Chat $Chat
    ) {
    }

    public function getId(): string {
        return $this->Chat->getId()->toString();
    }

    public function getCreatedAt(): string {
        return $this->Chat->getCreatedAt()->format('c');
    }

    public function getUpdatedAt(): string {
        return $this->Chat->getUpdatedAt()->format('c');
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
