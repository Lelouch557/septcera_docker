<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\ChatUser;

use App\Domain\Model\ChatUser\ChatUser;
use App\Domain\Repository\ChatRepositoryInterface;
use App\Domain\Repository\ChatUserRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;

final class CreateHandler {
    public function __construct(
        private ChatRepositoryInterface $ChatRepository,
        private ChatUserRepositoryInterface $chatUserRepository,
        private UserRepositoryInterface $UserRepository
        ) {
    }

    public function __invoke(CreateCommand $command): void {
        $chatUser = new ChatUser(
            Uuid::uuid4(),
            $this->ChatRepository->getSpecific(['id' => $command->getChatId()])[0],
            $this->UserRepository->getSpecific(['id' => $command->getUserId()])[0],
            new DateTime(),
            new DateTime()
        );
        $this->chatUserRepository->persist($chatUser);
    }
}
