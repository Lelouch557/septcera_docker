<?php
/*
 * mine -André
 */
namespace App\Domain\Model\Stockpile;
use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use App\Domain\Model\Resource\Resource;
use App\Domain\Model\User\User;
use App\Domain\Model\Village\Village;
use Ramsey\Uuid\UuidInterface;
class db{
    public function __toString()
    {
        return 'adf';
    }
}
class Stockpile extends DatabaseEntry{
    public function __construct(
        private UuidInterface $id,
        private Village $village,
        private Resource $resource,
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

    public function getVillage(): Village {
        return $this->village;
    }

    public function setVillage(Village $village): void {
        $this->village = $village;
    }

    public function getResource(): Resource {
        return $this->resource;
    }

    public function setResource(Resource $resource): void {
        $this->resource = $resource;
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
