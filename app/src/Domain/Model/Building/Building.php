<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Building;

use App\Domain\Model\BuildingTemplate\BuildingTemplate;
use App\Domain\Model\Village\Village;
use Ramsey\Uuid\UuidInterface;

class Building {
    public function __construct(
        private UuidInterface $id,
        private BuildingTemplate $buildingTemplate,
        private Village $village,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getBuilding(): BuildingTemplate {
        return $this->buildingTemplate;
    }

    public function getVillage(): Village {
        return $this->village;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    public function setBuilding(BuildingTemplate $buildingTemplate): void {
        $this->buildingTemplate = $buildingTemplate;
    }

    public function setVillage(Village $village): void {
        $this->village = $village;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
