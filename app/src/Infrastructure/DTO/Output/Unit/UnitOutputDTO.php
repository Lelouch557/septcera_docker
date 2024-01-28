<?php

/*
 * This file is Copyright
 */

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Output\Unit;

use App\Domain\Model\Unit\Unit;

final class UnitOutputDTO implements \JsonSerializable {
    public function __construct(
        private Unit $unit
    ) {
    }

    public function getId(): string {
        return $this->unit->getId()->toString();
    }

    public function getUnitTemplate(): string {
        return $this->unit->getUnitTemplate()->getId()->toString();
    }

    public function getVillage(): string {
        return $this->unit->getVillage()->getId()->toString();
    }

    public function getAmount(): int {
        return $this->unit->getAmount();
    }

    public function getCreatedAt(): string {
        return $this->unit->getCreatedAt()->format('c');
    }

    public function getUpdatedAt(): string {
        return $this->unit->getUpdatedAt()->format('c');
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'unitTemplate' => $this->getUnitTemplate(),
            'village' => $this->getVillage(),
            'amount' => $this->getAmount(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
