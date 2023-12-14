<?php

/*
 * This file is Copyrig
 */

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Output\Stockpile;

// use App\Domain\Model\stockpile\stockpile;

use App\Domain\Model\Resource\Resource;
use App\Domain\Model\Stockpile\Stockpile;
use App\Domain\Model\Village\Village;
use Ramsey\Uuid\UuidInterface;

final class SpecificOutputDTO implements \JsonSerializable {
    public function __construct(
        private Stockpile $stockpile
    ) {
    }

    public function getId(): UuidInterface {
        return $this->stockpile->getId();
    }

    public function getVillage(): UuidInterface {
        return $this->stockpile->getVillage()->getId();
    }

    public function getResource(): string {
        return $this->stockpile->getResource()->getName();
    }

    public function getAmount(): int {
        return $this->stockpile->getAmount();
    }

    public function getCreatedAt(): string {
        return $this->stockpile->getCreatedAt()->format('c');
    }

    public function getUpdatedAt(): string {
        return $this->stockpile->getUpdatedAt()->format('c');
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'village' => $this->getVillage(),
            'resource' => $this->getResource(),
            'amount' => $this->getAmount(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt()
        ];
    }
}
