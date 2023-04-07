<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\ChatBericht\ChatBericht;
use App\Domain\Repository\ChatBerichtRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class ChatBerichtRepository implements ChatBerichtRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function getSpecific(array $parameters): array {
        return $this->em->getRepository(ChatBericht::class)->findBy($parameters, ['createdAt' => 'ASC']);
    }

    public function delete(ChatBericht $chatBericht): void {
        $this->em->remove($chatBericht);
    }

    public function persist(ChatBericht $chatBericht): void {
        $this->em->persist($chatBericht);
        $this->em->flush();
    }
}
