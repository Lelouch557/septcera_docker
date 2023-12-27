<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Application\Command\Unit;

use Ramsey\Uuid\UuidInterface;

final class UpdateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly int $amount,
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getAmount(): int {
        return $this->amount;
    }
}
