<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Millitary;

use App\Domain\Model\Map\Coordinate;
use Ramsey\Uuid\UuidInterface;

class Garrison {
    public function __construct(
        private UuidInterface $id,
        private ?Army $army,
        private ?Legion $legion,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function idGet(): UuidInterface {
        return $this->id;
    }

    public function armyGet(): ?Army {
        return $this->army;
    }

    public function legionGet(): ?Legion {
        return $this->legion;
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

    public function armySet(?Army $army): void {
        $this->army = $army;
    }

    public function legionSet(Legion $legion): void {
        $this->legion = $legion;
    }

    public function createdAtSet(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function updatedAtSet(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
