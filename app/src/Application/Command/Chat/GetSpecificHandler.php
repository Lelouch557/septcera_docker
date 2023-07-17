<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Chat;

use App\Application\Command\Village\CreateCommand as VillageCreateCommand;
use App\Application\Exception\EntityAlreadyExistsException;
use App\Domain\Model\Chat\Chat;
use App\Domain\Repository\ChatRepositoryInterface;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\ChatPasswordHasherInterface;

class GetSpecificHandler {
    use HandleTrait;

    public function __construct(
        private ChatRepositoryInterface $repo,
        ) {
    }

    public function __invoke(GetSpecificCommand $command): array {
        return $this->repo->getSpecific($command->getParameters());
    }
}
