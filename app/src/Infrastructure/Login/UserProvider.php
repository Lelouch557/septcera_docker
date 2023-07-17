<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Login;

use App\Domain\Model\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserProvider implements UserProviderInterface, PasswordUpgraderInterface {
    public function __construct(
    private EntityManagerInterface $em
    ) {
    }

    public function loadUserByIdentifier(string $identifier): SecurityUser {    
        $user = $this->em->getRepository(USER::class)->findOneBy(['name' => $identifier]);
        try {
            $securityUser = new SecurityUser(
                $user->getId(),
                $user->getName(),
                $user->getPassword(),
                $user->getEmail(),
                $user->getRoles(),
            );

            return $securityUser;
        } catch (\Exception $e) {
            throw new \Exception('User not found');
        }
    }

    public function refreshUser(UserInterface $user) {
        if (!$user instanceof User) {
            throw new \Exception('Invalid user class');
        }
        throw new \Exception('TODO:: fill in refhreshUser');
    }

    public function supportsClass(string $class) {
        return User::class === $class || is_subclass_of($class, User::class);
    }

    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void {
    }
}
