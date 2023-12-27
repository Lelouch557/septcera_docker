<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Application\Command\Unit;

use Ramsey\Uuid\UuidInterface;

final class CreateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly UuidInterface $unitTemplate,
        private readonly UuidInterface $village,
        private readonly int $amount,
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getUnitTemplate(): UuidInterface {
        return $this->unitTemplate;
    }

    public function getVillage(): UuidInterface {
        return $this->village;
    }

    public function getAmount(): int {
        return $this->amount;
    }
}
