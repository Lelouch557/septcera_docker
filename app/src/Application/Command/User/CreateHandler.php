<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\User;

use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateHandler {
    public function __construct(
        private UserRepositoryInterface $repo,
        private UserPasswordHasherInterface $passwordHasher
        ) {
    }

    public function __invoke(CreateCommand $command): void {
        $existingUser = $this->repo->getSpecific(["name" => $command->getUserName()]);
        
        if($existingUser){
            throw new Exception("User already exists.");
        }

        $user = new User(
            $command->getId(),
            $command->getUserName(),
            $command->getPassword(),
            $command->getEmail(),
            $command->getConfirmationKey(),
            $command->getStatus(),
            $command->getRoles(),
            new DateTime(),
            new DateTime()
        );

        $user->setPassword($this->passwordHasher->hashPassword($user, $command->getPassword()));
        // print_r();
        $this->repo->persist($user);
    }
}
