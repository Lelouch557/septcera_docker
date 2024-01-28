<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query;

use App\Domain\Model\Building\Building;
use App\Domain\Model\Unit\Unit;
use App\Domain\Model\UnitTemplate\UnitTemplate;
use App\Domain\Model\User\User;
use App\Domain\Model\Village\Village;
use App\Domain\Repository\GenericRepositoryInterface;
use App\Domain\Repository\VillageRepositoryInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class GenericHandler{
    public function __construct(
        private GenericRepositoryInterface $genericRepository
    ) {
    }

    public function __invoke(GenericQuery $query) {
        $record = $this->genericRepository->pick(Unit::class, ['id' => '73d06c71-a0ee-4254-a508-c53b7319ecb5']);
        echo $record;
        die;
        return $record;
    }
}