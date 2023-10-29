<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\BuildingTemplate\BuildingTemplate;
use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use App\Domain\Model\DBEntry\DBEntry;
use App\Domain\Model\Stockpile\Stockpile;
use App\Domain\Repository\BuildingTemplateRepositoryInterface;
use App\Domain\Repository\GenericRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;
use stdClass;

class GenericRepository implements GenericRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function pick(string $class, array $parameters): ?DatabaseEntry {
        $b = $this->em->getRepository($class)->findOneBy($parameters);
        return $b;
    }

    public function get(string $class, array $parameters): array {
        return $this->em->getRepository($class)->findBy($parameters);
    }

    public function delete(DatabaseEntry $classInstance): void {
        $this->em->remove($classInstance);
    }

    public function set(DatabaseEntry $classInstance): void {
        $this->em->persist($classInstance);
    }
}
