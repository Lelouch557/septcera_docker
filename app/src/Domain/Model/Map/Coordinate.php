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

    public function setX($val) {
        $this->x = $val;
    }

    public function setY($val) {
        $this->y = $val;
    }

    public function setUpdatedAt(): void {
        $this->updatedAt = new \DateTime();
    }
}
