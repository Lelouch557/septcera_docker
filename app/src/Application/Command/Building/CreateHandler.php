<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Building;

use App\Application\Exception\EntityAlreadyExistsException;
use App\Application\Exception\EntityDoesNotExistException;
use App\Domain\Model\Building\Building;
use App\Domain\Repository\BuildingRepositoryInterface;
use App\Domain\Repository\VillageRepositoryInterface;
use App\Domain\Repository\BuildingTemplateRepositoryInterface;
use Ramsey\Uuid\Uuid;

final class CreateHandler {
    public function __construct(
        private BuildingRepositoryInterface $buildingRepo,
        private VillageRepositoryInterface $villagegRepo,
        private BuildingTemplateRepositoryInterface $buildingTemplateRepositoryRepo
        ) {
    }
    public function __invoke(CreateCommand $command) {
        $village = $this->villagegRepo->getSpecificOne(['id' => $command->getVillageId()]);

        $buildingExistsCheck = $this->buildingRepo->get([
            'buildingTemplate' => $command->getBuildingTemplateId(),
            'village' => $village     
        ]);

        if($buildingExistsCheck){
            throw new EntityAlreadyExistsException('building', '');
        }

        $village = $this->villagegRepo->getSpecificOne([
            'id' => $command->getVillageId()
        ]);

        if($buildingExistsCheck){
            throw new EntityDoesNotExistException('village', '');
        }

        $template = $this->buildingTemplateRepositoryRepo->pick(
            $command->getBuildingTemplateId()
        );

        if($buildingExistsCheck){
            throw new EntityDoesNotExistException('building template', '');
        }

        $building = new Building(
            $command->getId(),
            $template,
            $village,
            new \DateTime(),
            new \DateTime()
        );
        $this->buildingRepo->persist($building);
    }
}
