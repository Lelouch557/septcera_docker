<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Persistence\Doctrine\ORM\Repository;

use App\Domain\Model\BuildingTemplate\BuildingTemplate;
use App\Domain\Repository\BuildingTemplateRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Ramsey\Uuid\UuidInterface;

class BuildingTemplateRepository implements BuildingTemplateRepositoryInterface {
    public function __construct(
        private EntityManagerInterface $em
        ) {
    }

    public function pick(UuidInterface $id): ?BuildingTemplate {
        return $this->em->getRepository(BuildingTemplate::class)->find($id);
    }

    public function get(array $parameters): array {
        return $this->em->getRepository(BuildingTemplate::class)->findBy($parameters);
    }

    public function delete(BuildingTemplate $BuildingTemplate): void {
        $this->em->remove($BuildingTemplate);
    }

    public function persist(BuildingTemplate $BuildingTemplate): void {
        $this->em->persist($BuildingTemplate);
    }
}
