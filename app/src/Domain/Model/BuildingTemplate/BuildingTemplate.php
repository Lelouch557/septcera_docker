<?php

/*
 * mine -André
 */

namespace App\Domain\Model\BuildingTemplate;

use Ramsey\Uuid\UuidInterface;

class BuildingTemplate {
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private string $effect,
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

    public function getEffect(): string {
        return $this->effect;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    public function setName($name): void {
        $this->name = $name;
    }

    public function setEffect($effect): void {
        $this->effect = $effect;
    }

    public function setUpdatedAt(): void {
        $this->updatedAt = new \DateTime();
    }
}
