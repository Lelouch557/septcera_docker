<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\Village\Village;
use App\Domain\Repository\VillageRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class VillageRepository implements VillageRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function getSpecific(array $parameters): array {
        return $this->em->getRepository(Village::class)->findBy($parameters);
    }

    public function getSpecificOne(array $parameters): ?Village {
        return $this->em->getRepository(Village::class)->findOneBy($parameters);
    }

    public function delete(Village $village): void {
        $this->em->remove($village);
    }

    public function persist(Village $village): void {
        $this->em->persist($village);
    }
}
