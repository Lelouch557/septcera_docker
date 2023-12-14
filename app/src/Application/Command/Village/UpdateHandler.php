<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Village;

use App\Domain\Model\Map\Coordinate;
use App\Domain\Model\Village\Village;
use App\Domain\Repository\CoordinateRepositoryInterface;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Repository\VillageRepositoryInterface;
use App\Infrastructure\Service\CurrentAdminService;
use DateTime;
use Ramsey\Uuid\Uuid;

final class UpdateHandler {
    public function __construct(
        private VillageRepositoryInterface $villageRepo,
        private UserRepositoryInterface $userRepo,
        private CoordinateRepositoryInterface $mapRepo
        ) {
    }
    public function __invoke(UpdateCommand $command) {
        $village = $this->villageRepo->pick(['id', $command->get('id')]);
        $this->villageRepo->persist($village);
    }

    function spiral($num) {
        $x = 0;
        $y = 0;
        $distance = 0;
        $direction = 0;  // 0 = right, 1 = up, 2 = left, 3 = down
        $walkedPath = 0;
        while ($num > 0) {
            $walkedPath = floor(($distance + 1) / 2);
            for ($i = 0; $i < $walkedPath; $i++) {
                switch ($direction) {
                    case 0:
                        $x = $x - 5;
                        break;
                    case 1:
                        $y = $y - 5;
                        break;
                    case 2:
                        $x = $x + 5;
                        break;
                    case 3:
                        $y = $y + 5;
                        break;
                }
                $num--;
                if ($num == 0) {
                    break 2;
                }
            }
            $distance++;
            $direction = ($direction + 1) % 4;
        }
        return array($x, $y);
    }
}
