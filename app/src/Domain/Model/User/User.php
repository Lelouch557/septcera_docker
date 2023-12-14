<?php
/*
 * mine -André
 */
namespace App\Domain\Model\User;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
class User implements PasswordAuthenticatedUserInterface {
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private string $password,
        private string $email,
        private string $confirmationKey,
        private string $status,
        private array $roles,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }
    public function __toString()
    {
        return printf('
            id = %s,
            name = %s,
            password = %s,
            email = %s,
            confirmationKey = %s,
            status = %s,
            roles = %s,
            createdAt = %s,
            updatedA = %s',
            $this->id,
            $this->name,
            $this->password,
            $this->email,
            $this->confirmationKey,
            $this->status,
            $this->roles,
            $this->createdAt,
            $this->updatedAt
        );
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function getPassword(): string {
        return $this->password;
    }

    public function setPassword(string $password): void {
        $this->password = $password;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    public function getConfirmationKey(): string {
        return $this->confirmationKey;
    }

    public function setConfirmationKey(string $confirmationKey): void {
        $this->confirmationKey = $confirmationKey;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        $this->status = $status;
    }

    public function getRoles(): array {
        return $this->roles;
    }

    public function setRoles(array $roles): void {
        $this->roles = $roles;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
