<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Millitary;

use Ramsey\Uuid\UuidInterface;

class Component {
    public function __construct(
        private UuidInterface $id,
        private Unit $unit,
        private int $dmg,
        private string $dmgType,
        private string $name,
        private int $armour,
        private int $shield,
        private int $armourPen,
        private int $shieldPen,
        private int $movementSpeed,
        private int $drag,
        private \DateTime $createdAt,
        private \DateTime $updatedAt,
    ) {
    }

    public function idGet(): UuidInterface {
        return $this->id;
    }

    public function unitGet(): Unit {
        return $this->unit;
    }

    public function dmgGet(): int {
        return $this->dmg;
    }

    public function dmgTypeGet(): string {
        return $this->dmgType;
    }

    public function nameGet(): string {
        return $this->name;
    }

    public function armourGet(): int {
        return $this->armour;
    }

    public function shieldGet(): int {
        return $this->shield;
    }

    public function armourPenGet(): int {
        return $this->armourPen;
    }

    public function shieldPenGet(): int {
        return $this->shieldPen;
    }

    public function movementSpeedGet(): int {
        return $this->movementSpeed;
    }

    public function dragGet(): int {
        return $this->drag;
    }

    public function createdAtGet(): \DateTime {
        return $this->createdAt;
    }

    public function updatedAtGet(): \DateTime {
        return $this->updatedAt;
    }

    public function idSet(UuidInterface $id): void {
        $this->id = $id;
    }

    public function unitSet(Unit $unit): void {
        $this->unit = $unit;
    }

    public function dmgSet(int $dmg): void {
        $this->dmg = $dmg;
    }

    public function dmgTypeSet(string $dmgType): void {
        $this->dmgType = $dmgType;
    }

    public function nameSet(string $name): void {
        $this->name = $name;
    }

    public function armourSet(int $armour): void {
        $this->armour = $armour;
    }

    public function shieldSet(int $shield): void {
        $this->shield = $shield;
    }

    public function armourPenSet(int $armourPen): void {
        $this->armourPen = $armourPen;
    }

    public function shieldPenSet(int $shieldPen): void {
        $this->shieldPen = $shieldPen;
    }

    public function movementSpeedSet(int $movementSpeed): void {
        $this->movementSpeed = $movementSpeed;
    }

    public function dragSet(int $drag): void {
        $this->drag = $drag;
    }

    public function createdAtSet(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function updatedAtSet(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
