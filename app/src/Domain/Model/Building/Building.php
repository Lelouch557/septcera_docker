<?php
/*
 * mine -André
 */
namespace App\Domain\Model\Building;
use App\Domain\Model\BuildingTemplate\BuildingTemplate;
use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use App\Domain\Model\Village\Village;
use Ramsey\Uuid\UuidInterface;
class Building extends DatabaseEntry {
    public function __construct(
        private UuidInterface $id,
        private BuildingTemplate $buildingTemplate,
        private Village $village,
        private int $amount,
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
    public function getAmount(): int {
        return $this->amount;
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
    public function setAmount(int $amount): void {
        $this->amount = $amount;
    }
    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
    public function __toString()
    {
        $msg = '';
        $msg .= '\r\n'.$this->id;
        $msg .= '\r\n'.$this->buildingTemplate;
        $msg .= '\r\n'.$this->village;
        $msg .= '\r\n'.$this->amount;
        $msg .= '\r\n'.$this->createdAt;
        $msg .= '\r\n'.$this->updatedAt;
        return $msg;
    }

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function getBuildingTemplate(): BuildingTemplate {
        return $this->buildingTemplate;
    }

    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }
}
