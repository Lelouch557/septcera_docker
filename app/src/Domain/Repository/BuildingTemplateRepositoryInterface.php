<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\BuildingTemplate\BuildingTemplate;
use Ramsey\Uuid\UuidInterface;

interface BuildingTemplateRepositoryInterface {
    public function pick(UuidInterface $parameters): ?BuildingTemplate;

    public function get(array $parameters): array;

    public function delete(BuildingTemplate $building): void;

    public function persist(BuildingTemplate $building): void;
}
