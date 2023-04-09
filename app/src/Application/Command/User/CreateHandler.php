<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\User;

use App\Application\Exception\EntityAlreadyExistsException;
use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateHandler {
    public function __construct(
        private UserRepositoryInterface $repo,
        private UserPasswordHasherInterface $passwordHasher
        ) {
    }

    public function __invoke(CreateCommand $command): void {
        $existingUserByName = $this->repo->getSpecific(['name' => $command->getUserName()]);
        if ($existingUserByName) {
            throw new EntityAlreadyExistsException("User", $existingUserByName[0]->getName());
        }

        $existingUserByMail = $this->repo->getSpecific(['email' => $command->getEmail()]);
        if ($existingUserByMail) {
            throw new EntityAlreadyExistsException("User", $existingUserByMail[0]->getEmail());
        }

        $user = new User(
            $command->getId(),
            $command->getUserName(),
            $command->getPassword(),
            $command->getEmail(),
            $command->getConfirmationKey(),
            $command->getStatus(),
            $command->getRoles(),
            new \DateTime(),
            new \DateTime()
        );

        $user->setPassword($this->passwordHasher->hashPassword($user, $command->getPassword()));
        $this->repo->persist($user);
    }
}
