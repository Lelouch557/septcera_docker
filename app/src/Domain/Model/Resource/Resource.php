<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Resource;

use Ramsey\Uuid\UuidInterface;

class Resource {
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime {
        return new \DateTime();
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setUpdatedAt(): void {
        $this->updatedAt = new \DateTime();
    }
}
