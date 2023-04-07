<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Chat;

use Ramsey\Uuid\UuidInterface;

final class CreateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly array $users
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getUsers(): array {
        return $this->users;
    }
}
