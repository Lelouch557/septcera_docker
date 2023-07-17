<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\User;

use App\Application\Command\Village\CreateCommand as VillageCreateCommand;
use App\Application\Exception\EntityAlreadyExistsException;
use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class GetSpecificHandler {
    use HandleTrait;

    public function __construct(
        private UserRepositoryInterface $repo,
        ) {
    }

    public function __invoke(GetSpecificCommand $command): array {
        return $this->repo->getSpecific($command->getParameters());
    }
}
