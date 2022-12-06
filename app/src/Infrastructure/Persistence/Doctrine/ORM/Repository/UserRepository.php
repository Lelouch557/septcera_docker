<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class UserRepository implements UserRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function getSpecific(array $parameters): array {
        return $this->em->getRepository(User::class)->findBy($parameters);
    }

    public function delete(User $user): void {
        $this->em->remove($user);
    }

    public function persist(User $user): void {
        $this->em->persist($user);
    }
}
