<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Chat;

use App\Domain\Model\Chat\Chat;
use App\Domain\Model\ChatUser\ChatUser;
use App\Domain\Repository\ChatRepositoryInterface;
use App\Domain\Repository\ChatUserRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;

final class CreateHandler {
    public function __construct(
        private ChatRepositoryInterface $repo,
        private ChatUserRepositoryInterface $chatUserRepository,
        private UserRepositoryInterface $userRepo
        ) {
    }

    public function __invoke(CreateCommand $command): void {
        $users = [];
        foreach($command->getUsers() as $userId){
            $result = $this->userRepo->getSpecific(['id' => $userId]);
            if(!$result) throw new Exception('needs custom exception. user not in db');
            array_push($users, $result[0]);
        }

        $chat = new Chat(
            $command->getId(),
            new DateTime(),
            new DateTime()
        );
        $this->repo->persist($chat);

        foreach($users as $user){
            $chatUser = new ChatUser(
                Uuid::uuid4(),
                $chat,
                $user,
                new DateTime(),
                new DateTime()
            );
            $this->chatUserRepository->persist($chatUser);
        }
    }
}
