<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Login;

use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class SecurityUser implements UserInterface, PasswordAuthenticatedUserInterface {
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private string $password,
        private string $email,
        private array $roles,
    ) {
    }

    public function getUserIdentifier(): string {
        return $this->name;
    }

    public function eraseCredentials() {
        $this->password = '';
        $this->email = '';
        $this->name = '';
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getRoles(): array {
        return $this->roles;
    }
}
