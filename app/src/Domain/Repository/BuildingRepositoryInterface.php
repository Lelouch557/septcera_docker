<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\Building\Building;
use Ramsey\Uuid\UuidInterface;

interface BuildingRepositoryInterface {
    public function pick(UuidInterface $parameters): Building;

    public function get(array $parameters): array;

    public function delete(Building $building): void;

    public function persist(Building $building): void;
}
