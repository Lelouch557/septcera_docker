<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Millitary;

use App\Domain\Model\Map\Coordinate;
use Ramsey\Uuid\UuidInterface;

class Army {
    public function __construct(
        private UuidInterface $id,
        private ?UuidInterface $garrison,
        private Commander $commander,
        private Coordinate $coordinate,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function idGet(): UuidInterface {
        return $this->id;
    }

    public function garrisonGet(): ?UuidInterface {
        return $this->garrison;
    }

    public function commanderGet(): Commander {
        return $this->commander;
    }

    public function coordinateGet(): Coordinate {
        return $this->coordinate;
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

    public function garrisonSet(?UuidInterface $garrison): void {
        $this->garrison = $garrison;
    }

    public function commanderSet(Commander $commander): void {
        $this->commander = $commander;
    }

    public function coordinateSet(Coordinate $coordinate): void {
        $this->coordinate = $coordinate;
    }

    public function createdAtSet(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function updatedAtSet(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
