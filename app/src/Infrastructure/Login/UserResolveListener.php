<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Login;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

final class UserResolveListener {
    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * @var UserPasswordHasherInterface
     */
    private $userPasswordHasher;

    public function __construct(UserProviderInterface $userProvider, UserPasswordHasherInterface $userPasswordHasher) {
        $this->userProvider = $userProvider;
        $this->userPasswordHasher = $userPasswordHasher;
    }
}
