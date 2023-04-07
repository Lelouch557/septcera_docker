<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\ChatBericht;

use App\Domain\Model\ChatBericht\ChatBericht;
use App\Domain\Repository\ChatBerichtRepositoryInterface;
use App\Domain\Repository\ChatRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use Ramsey\Uuid\Uuid;

final class CreateHandler {
    public function __construct(
        private ChatRepositoryInterface $ChatRepository,
        private ChatBerichtRepositoryInterface $ChatBerichtRepository,
        private UserRepositoryInterface $UserRepository
        ) {
    }

    public function __invoke(CreateCommand $command): void {
        $chatBericht = new ChatBericht(
            Uuid::uuid4(),
            $this->ChatRepository->getSpecific(['id' => $command->getChatId()])[0],
            $this->UserRepository->getSpecific(['id' => $command->getUserId()])[0],
            $command->getText(),
            new \DateTime(),
            new \DateTime()
        );
        $this->ChatBerichtRepository->persist($chatBericht);
    }
}
