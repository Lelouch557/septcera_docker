<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\BuildingTemplate\BuildingTemplate;
use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use App\Domain\Model\DBEntry\DBEntry;
use Ramsey\Uuid\UuidInterface;
use stdClass;

interface GenericRepositoryInterface {
    public function pick(string $class, array $parameters): ?DatabaseEntry;

    public function get(string $class, array $parameters): array;

    public function delete(DatabaseEntry $classInstance): void;

    public function set(DatabaseEntry $classInstance): void;
}
