<?php
/*
 * mine -André
 */
namespace App\Domain\Model\Chat;
use DateTime;
use Ramsey\Uuid\UuidInterface;
class Chat {
    public function __construct(
        private UuidInterface $id,
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
