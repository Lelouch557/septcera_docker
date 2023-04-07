<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Chat;

use Ramsey\Uuid\UuidInterface;

class Chat {
    public function __construct(
        private UuidInterface $id,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getCreatedAt(): void {
        $this->createdAt = $this->createdAt;
    }

    public function getUpdatedAt(): void {
        $this->updatedAt = $this->updatedAt;
    }
}
