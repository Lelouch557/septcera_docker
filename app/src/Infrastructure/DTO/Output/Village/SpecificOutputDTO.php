<?php

/*
 * This file is Copyright (c) - Move4Mobile B.V. (https://move4mobile.com)
 */

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Output\Village;

use App\Domain\Model\Village\Village;

final class SpecificOutputDTO implements \JsonSerializable {
    public function __construct(
        private Village $village
    ) {
    }

    public function getId(): string {
        return $this->village->getId()->toString();
    }

    public function getUser(): string {
        return $this->village->getUser()->getId()->toString();
    }

    public function getName(): string {
        return $this->village->getName();
    }

    public function getType(): string {
        return $this->village->getType();
    }

    public function getX(): string {
        return strval($this->village->getX());
    }

    public function getY(): string {
        return strval($this->village->getY());
    }

    // public function getStatus(): string
    // {
    //     return $this->village->getStatus();
    // }

    public function getCreatedAt(): string {
        return $this->village->getCreatedAt()->format('c');
    }

    public function getUpdatedAt(): string {
        return $this->village->getUpdatedAt()->format('c');
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'user_id' => $this->getUser(),
            'name' => $this->getName(),
            'type' => $this->getType(),
            'status' => 'not implemented',
            'x' => $this->getX(),
            'y' => $this->getY(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
