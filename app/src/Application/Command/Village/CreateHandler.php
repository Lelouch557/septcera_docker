<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Village;

use App\Domain\Model\Village\Village;
use App\Domain\Repository\UserRepositoryInterface;
use App\Domain\Repository\VillageRepositoryInterface;
use App\Infrastructure\Service\CurrentAdminService;

final class CreateHandler {
    public function __construct(
        private VillageRepositoryInterface $villageRepo,
        private CurrentAdminService $adminService,
        private UserRepositoryInterface $userRepo
        ) {
    }

    public function __invoke(CreateCommand $command): void {
        $user = $this->adminService->getCurrentUser();
        $villageExists = $this->villageRepo->getSpecific(['x' => $command->getX(), 'y' => $command->getY()]);

        if ($villageExists) {
            throw new \Exception('needs custom exception. something already exists on this spot.');
        }

        $village = new Village(
            $command->getId(),
            $user,
            $command->getName(),
            $command->getType(),
            $command->getX(),
            $command->getY(),
            new \DateTime(),
            new \DateTime()
        );

        $this->villageRepo->persist($village);
    }
}
