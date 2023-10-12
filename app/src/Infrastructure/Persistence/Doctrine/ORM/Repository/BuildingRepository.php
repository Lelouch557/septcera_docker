<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\Building\Building;
use App\Domain\Repository\BuildingRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class BuildingRepository implements BuildingRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function pick(UuidInterface $id): Building {
        return $this->em->getRepository(Building::class)->find($id);
    }

    public function get(array $parameters): array {
        return $this->em->getRepository(Building::class)->findBy($parameters);
    }

    public function delete(Building $Building): void {
        $this->em->remove($Building);
    }

    public function persist(Building $Building): void {
        $this->em->persist($Building);
    }
}
