<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\Map\Coordinate;
use App\Domain\Repository\CoordinateRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

class CoordinateRepository implements CoordinateRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function getSpecific(array $parameters): array {
        return $this->em->getRepository(Coordinate::class)->findBy($parameters);
    }

    public function getAll(): array {
        return $this->em->getRepository(Coordinate::class)->findAll();
    }

    public function getSpecificOne(array $parameters): ?Coordinate {
        return $this->em->getRepository(Coordinate::class)->findOneBy($parameters);
    }

    public function getCount(): int {
        return $this->em->getRepository(Coordinate::class)->count();
    }

    public function delete(Coordinate $village): void {
        $this->em->remove($village);
    }

    public function persist(Coordinate $village): void {
        $this->em->persist($village);
    }
}
