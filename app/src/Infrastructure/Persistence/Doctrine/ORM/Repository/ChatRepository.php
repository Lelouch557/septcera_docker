<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\Chat\Chat;
use App\Domain\Repository\ChatRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ChatRepository implements ChatRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function getSpecific(array $parameters): array {
        return $this->em->getRepository(Chat::class)->findBy($parameters);
    }

    public function delete(Chat $chat): void {
        $this->em->remove($chat);
    }

    public function persist(Chat $chat): void {
        $this->em->persist($chat);
    }
}
