<?php
/*
 * mine -André
 */
namespace App\Domain\Model\Millitary;
use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use Ramsey\Uuid\UuidInterface;
class Army extends DatabaseEntry{
    public function __construct(
        private UuidInterface $id,
        private Unit $unit,
        private int $amount,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function getUnit(): Unit {
        return $this->unit;
    }

    public function setUnit(Unit $unit): void {
        $this->unit = $unit;
    }

    public function getAmount(): int {
        return $this->amount;
    }

    public function setAmount(int $amount): void {
        $this->amount = $amount;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
