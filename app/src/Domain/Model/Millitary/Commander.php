<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Millitary;

use Ramsey\Uuid\UuidInterface;

class Commander {
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private int $age,
        private string $management,
        private string $command,
        private string $influence,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getname(): string {
        return $this->name;
    }

    public function getage(): int {
        return $this->age;
    }

    public function getmanagement(): string {
        return $this->management;
    }

    public function getcommand(): string {
        return $this->command;
    }

    public function getinfluence(): string {
        return $this->influence;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAge($age) {
        $this->age = $age;
    }

    public function setManagement($management) {
        $this->management = $management;
    }

    public function setCommand($command) {
        $this->command = $command;
    }

    public function setInfluence($influence) {
        $this->influence = $influence;
    }

    public function setUpdatedAt(): void {
        $this->updatedAt = new \DateTime();
    }
}
