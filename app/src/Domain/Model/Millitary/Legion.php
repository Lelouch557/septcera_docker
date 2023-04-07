<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Millitary;

use App\Domain\Model\Map\Coordinate;
use Ramsey\Uuid\UuidInterface;

class Legion {
    public function __construct(
        private UuidInterface $id,
        private ?Garrison $garrison,
        private ?Army $army,
        private ?Commander $commander,
        private int $morale,
        private int $provisions,
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

    public function armyGet(): ?Army {
        return $this->army;
    }

    public function commanderGet(): ?Commander {
        return $this->commander;
    }

    public function moraleGet(): int {
        return $this->morale;
    }

    public function provisionsGet(): int {
        return $this->provisions;
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

    public function armySet(?Army $army): void {
        $this->army = $army;
    }

    public function commanderSet(?Commander $commander): void {
        $this->commander = $commander;
    }

    public function moraleSet(int $morale): void {
        $this->morale = $morale;
    }

    public function provisionsSet(int $provisions): void {
        $this->provisions = $provisions;
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
