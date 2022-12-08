<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\ChatUser\ChatUser;
use App\Domain\Repository\ChatUserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ChatUserRepository implements ChatUserRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function getSpecific(array $parameters): array {
        return $this->em->getRepository(ChatUser::class)->findBy($parameters);
    }

    public function delete(ChatUser $chat): void {
        $this->em->remove($chat);
    }

    public function persist(ChatUser $chat): void {
        $this->em->persist($chat);
    }
}
