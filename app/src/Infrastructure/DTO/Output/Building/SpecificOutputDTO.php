<?php

/*
 * This file is Copyrig
 */

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Output\Building;

use App\Domain\Model\Building\Building;
use Ramsey\Uuid\UuidInterface;

final class SpecificOutputDTO implements \JsonSerializable {
    public function __construct(
        private Building $building
    ) {
    }

    public function getId(): string {
        return $this->building->getId()->toString();
    }

    public function getType(): string {
        return $this->building->getBuilding()->getName();
    }

    public function getVillage(): string {
        return $this->building->getVillage()->getId()->toString();
    }

    public function getEffect(): string {
        return $this->building->getBuilding()->getEffect();
    }

    public function getTemplateId(): string {
        return $this->building->getBuilding()->getId()->toString();
    }

    public function getCreatedAt(): string {
        return $this->building->getCreatedAt()->format('c');
    }

    public function getUpdatedAt(): string {
        return $this->building->getUpdatedAt()->format('c');
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'type' => $this->getType(),
            'village' => $this->getVillage(),
            'effect' => $this->getEffect(),
            'template' => $this->getTemplateId(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
