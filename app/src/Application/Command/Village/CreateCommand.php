<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Village;

use App\Domain\Model\User\User;
use Ramsey\Uuid\UuidInterface;

final class CreateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly string $name,
        private readonly string $type,
        private readonly int $x,
        private readonly int $z,
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getType(): string {
        return $this->type;
    }
    public function getX(): int {
        return $this->x;
    }
    public function getY(): int {
        return $this->z;
    }
}
