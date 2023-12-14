<?php
/*
 * mine -André
 */
namespace App\Domain\Model\Resource;
use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use Ramsey\Uuid\UuidInterface;
class Resource extends DatabaseEntry{
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

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
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
