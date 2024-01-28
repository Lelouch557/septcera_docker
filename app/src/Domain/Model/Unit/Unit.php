<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Domain\Model\Unit;

use Ramsey\Uuid\UuidInterface;
use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use App\Domain\Model\UnitTemplate\UnitTemplate;
use App\Domain\Model\Village\Village;
use App\Infrastructure\DTO\Output\Unit\UnitOutputDTO;

final class Unit extends DatabaseEntry {
    public function __construct(
        private UuidInterface $id,
        private UnitTemplate $unitTemplate,
        private Village $village,
        private int $amount,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ){
    }

    public function getId(): UuidInterface{
        return $this->id;
    }

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function getUnitTemplate(): UnitTemplate{
        return $this->unitTemplate;
    }

    public function setUnitTemplate(UnitTemplate $unitTemplate): void {
        $this->unitTemplate = $unitTemplate;
    }

    public function getVillage(): Village{
        return $this->village;
    }

    public function setVillage(Village $village): void {
        $this->village = $village;
    }

    public function getAmount(): int{
        return $this->amount;
    }

    public function setAmount(int $amount): void {
        $this->amount = $amount;
    }

    public function getCreatedAt(): \DateTime{
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime{
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }

    public function __toString()
    {
        return  json_encode(new UnitOutputDTO($this));
    }
}
