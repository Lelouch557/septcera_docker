<?php
/*
 * mine -André
 */
namespace App\Domain\Model\Map;
use Ramsey\Uuid\UuidInterface;
class Coordinate {
    public function __construct(
        private UuidInterface $id,
        private int $x,
        private int $y,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }
    public function getId(): UuidInterface {
        return $this->id;
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
        return $this->updatedAt;
    }
    public function getCoordinates(): array {
        return [$this->x, $this->y];
    }

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function setX(int $x): void {
        $this->x = $x;
    }

    public function setY(int $y): void {
        $this->y = $y;
    }

    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
