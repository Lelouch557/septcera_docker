<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Application\Command\UnitTemplate;

use Ramsey\Uuid\UuidInterface;

final class CreateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly string $name,
        private readonly int $offence,
        private readonly int $defense,
        private readonly int $hp,
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getOffence(): int {
        return $this->offence;
    }

    public function getDefense(): int {
        return $this->defense;
    }

    public function getHp(): int {
        return $this->hp;
    }
}
