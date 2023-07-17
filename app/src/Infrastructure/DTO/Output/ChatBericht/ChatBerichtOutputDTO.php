<?php

/*
 * This file is Copyright (c) - Move4Mobile B.V. (https://move4mobile.com)
 */

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Output\ChatBericht;

use App\Domain\Model\ChatBericht\ChatBericht;

final class ChatBerichtOutputDTO implements \JsonSerializable {
    public function __construct(
        private ChatBericht $ChatBericht
    ) {
    }

    public function getId(): string {
        return $this->ChatBericht->getId()->toString();
    }

    public function getText(): string {
        return $this->ChatBericht->getText();
    }

    public function getUser(): string {
        return $this->ChatBericht->getUser()->getName();
    }

    public function getCreatedAt(): string {
        return $this->ChatBericht->getCreatedAt()->format('c');
    }

    public function getUpdatedAt(): string {
        return $this->ChatBericht->getUpdatedAt()->format('c');
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'text' => $this->getText(),
            'user' => $this->getUser(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
