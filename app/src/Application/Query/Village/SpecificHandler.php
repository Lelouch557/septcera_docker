<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query\Village;

use App\Domain\Repository\ChatBerichtRepositoryInterface;
use App\Domain\Repository\VillageRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class SpecificHandler {
    public function __construct(
        private VillageRepositoryInterface $villageRepositoryInterface
    ) {
    }

    public function __invoke(SpecificQuery $query)
    {
        $parameters = $query->getParameters();

        return $this->villageRepositoryInterface->getSpecific($parameters);
    }
}
