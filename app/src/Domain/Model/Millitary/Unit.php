<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Millitary;

use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use Ramsey\Uuid\UuidInterface;

class Unit extends DatabaseEntry{
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private int $offence,
        private int $defense,
        private int $hp,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
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

    public function setOffence($offence): void {
        $this->offence = $offence;
    }

    public function setDefense($defense): void {
        $this->defense = $defense;
    }

    public function setHp($hp): void {
        $this->hp = $hp;
    }

    public function setId($id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getOffence(): int {
        return $this->offence;
    }

    public function getDefense(): int {
        return $this->defense;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function setCreatedAt($createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt($updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
