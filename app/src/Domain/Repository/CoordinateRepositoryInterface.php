<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\Map\Coordinate;

interface CoordinateRepositoryInterface {
    public function getAll(): array;

    public function getSpecific(array $parameters): array;

    public function getSpecificOne(array $parameters): ?Coordinate;

    public function getCount(): int;

    public function delete(Coordinate $village): void;

    public function persist(Coordinate $village): void;
}
