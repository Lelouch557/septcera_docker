<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\User;

use Ramsey\Uuid\UuidInterface;

class CreateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly string $userName,
        private readonly string $password,
        private readonly string $email,
        private readonly string $confirmationKey,
        private readonly string $status,
        private readonly array $roles,
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getUserName(): string {
        return $this->userName;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getConfirmationKey(): string {
        return $this->confirmationKey;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function getRoles(): array {
        return $this->roles;
    }
}
