<?php

/*
 * This file is Copyright (c) - Move4Mobile B.V. (https://move4mobile.com)
 */

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Output\User;

use App\Domain\Model\User\User;

final class UserOutputDTO implements \JsonSerializable {
    public function __construct(
        private User $user
    ) {
    }

    public function getId(): string {
        return $this->user->getId()->toString();
    }

    public function getName(): string {
        return $this->user->getName();
    }

    public function getEmail(): string {
        return $this->user->getEmail();
    }

    public function getCreatedAt(): string {
        return $this->user->getCreatedAt()->format('c');
    }

    public function getUpdatedAt(): string {
        return $this->user->getUpdatedAt()->format('c');
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
