<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Domain\Model\UnitTemplate;

use Ramsey\Uuid\UuidInterface;
use App\Domain\Model\DatabaseEntry\DatabaseEntry;

final class UnitTemplate extends DatabaseEntry {
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private int $offence,
        private int $defense,
        private int $hp,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ){
    }

    public function getId(): UuidInterface{
        return $this->id;
    }

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getOffence(): int{
        return $this->offence;
    }

    public function setOffence(int $offence): void {
        $this->offence = $offence;
    }

    public function getDefense(): int{
        return $this->defense;
    }

    public function setDefense(int $defense): void {
        $this->defense = $defense;
    }

    public function getHp(): int{
        return $this->hp;
    }

    public function setHp(int $hp): void {
        $this->hp = $hp;
    }

    public function getCreatedAt(): \DateTime{
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime{
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->$updatedAt = $updatedAt;
    }
}
