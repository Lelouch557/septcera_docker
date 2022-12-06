<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\User;

use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use DateTime;

class CreateHandler {
    public function __construct(
        private UserRepositoryInterface $repo) {
    }

    public function __invoke(CreateCommand $command): void {
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
        $this->repo->persist($user);
    }
}
