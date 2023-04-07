<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Login;

use League\Bundle\OAuth2ServerBundle\Event\UserResolveEvent;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class SecurityUserResolver extends AbstractController implements UserInterface, PasswordAuthenticatedUserInterface {
    public function __construct(
        private ?UserProviderInterface $userProvider = null,
        private ?UserPasswordHasherInterface $userPasswordHasher = null
    ) {
    }

    public function onUserResolve(UserResolveEvent $event): void {
        try {
            $user = $this->userProvider->loadUserByIdentifier($event->getUsername());
        } catch (AuthenticationException $e) {
            return;
        }
        if (null === $user || !($user instanceof PasswordAuthenticatedUserInterface)) {
            return;
        }
        if (!$this->userPasswordHasher->isPasswordValid($user, $event->getPassword())) {
            return;
        }
        $event->setUser($user);
    }

    public function getUserIdentifier(): string {
        return (string) $this->email;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function getRoles(): array {
        return $this->email;
    }

    public function eraseCredentials(): void {
    }
}
