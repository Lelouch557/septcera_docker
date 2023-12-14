<?php/* * mine -André */namespace App\Domain\Model\Millitary;use App\Domain\Model\DatabaseEntry\DatabaseEntry;use Ramsey\Uuid\UuidInterface;class Army extends DatabaseEntry{    public function __construct(        private UuidInterface $id,        private Unit $unit,        private int $amount,        private \DateTime $createdAt,        private \DateTime $updatedAt    ) {    }
    public function getId(): UuidInterface {        return $this->id;    }
    public function setId($id): void {        $this->id = $id;    }
    public function getUnit(): Unit {        return $this->unit;    }
    public function setUnit($unit): void {        $this->unit = $unit;    }
    public function getAmount(): int {        return $this->amount;    }
    public function setAmount($amount): void {        $this->amount = $amount;    }
    public function getCreatedAt(): \DateTime {        return $this->createdAt;    }
    public function setCreatedAt($createdAt): void {        $this->createdAt = $createdAt;    }
    public function getUpdatedAt(): \DateTime {        return $this->updatedAt;    }
    public function setUpdatedAt($updatedAt): void {        $this->updatedAt = $updatedAt;    }}