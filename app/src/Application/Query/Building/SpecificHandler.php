<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query\Building;

use App\Domain\Repository\BuildingRepositoryInterface;

class SpecificHandler {
    public function __construct(
        private BuildingRepositoryInterface $buildingRepositoryInterface
    ) {
    }

    public function __invoke(SpecificQuery $query) {
        $parameters = $query->getParameters();
        // print_r($parameters);
        // die;
        return $this->buildingRepositoryInterface->get($parameters);
    }
}
