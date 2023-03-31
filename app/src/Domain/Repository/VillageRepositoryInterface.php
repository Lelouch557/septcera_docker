<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\Village\Village;

interface VillageRepositoryInterface {
    public function getSpecific(array $parameters): array;

    public function getSpecificOne(array $parameters): ?Village;

    public function delete(Village $village): void;

    public function persist(Village $village): void;
}
