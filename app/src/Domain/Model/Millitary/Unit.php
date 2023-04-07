<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Millitary;

use App\Domain\Model\Map\Coordinate;
use Ramsey\Uuid\UuidInterface;

class Unit {
    public function __construct(
        private UuidInterface $id,
        private Legion $legion,
        private Coordinate $coordinate,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function idGet(): UuidInterface {
        return $this->id;
    }

    public function idSet(UuidInterface $id) {
        $this->id = $id;
    }

    public function legionGet(): Legion {
        return $this->legion;
    }

    public function legionSet(Legion $legion) {
        $this->legion = $legion;
    }

    public function coordinateGet(): Coordinate {
        return $this->coordinate;
    }

    public function coordinateSet(Coordinate $coordinate) {
        $this->coordinate = $coordinate;
    }

    public function createdAtGet(): \DateTime {
        return $this->createdAt;
    }

    public function createdAtSet(\DateTime $createdAt) {
        $this->createdAt = $createdAt;
    }

    public function updatedAtGet(): \DateTime {
        return $this->updatedAt;
    }

    public function updatedAtSet(\DateTime $updatedAt) {
        $this->updatedAt = $updatedAt;
    }
}
