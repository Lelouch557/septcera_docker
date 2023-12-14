<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Village;

use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use App\Domain\Model\User\User;
use Ramsey\Uuid\UuidInterface;

class Village extends DatabaseEntry{
    public function __construct(
        private UuidInterface $id,
        private User $user,
        private string $name,
        private string $type,
        private int $x,
        private int $y,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getUser(): User {
        return $this->user;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getX(): int {
        return $this->x;
    }

    public function getY(): int {
        return $this->y;
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

    public function setType($type): void {
        $this->type = $type;
    }

    public function setUpdatedAt(): void {
        $this->updatedAt = new \DateTime();
    }

    public function __toString()
    {
        return printf('
            id = %s,
            user = %s,
            name = %s,
            type = %s,
            x = %s,
            y = %s,
            createdAt = %s,
            updatedAt = %s',
            $this->id,
            $this->user->getId(),
            $this->name,
            $this->type,
            $this->x,
            $this->y,
            $this->createdAt,
            $this->updatedAt
        );
    }
}