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

        if(!$village){
            throw new EntityDoesNotExistException('village', '');
        }

        $template = $this->buildingTemplateRepositoryRepo->get(
            [ 'name' => $command->getBuildingname()]
        );

        if(!$template){
            throw new EntityDoesNotExistException('building template', '');
        }

        $buildingExistsCheck = $this->buildingRepo->get([
            'buildingTemplate' => $template[0],
            'village' => $village     
        ]);

        if($buildingExistsCheck){
            /** @var building $building */
            $building = $buildingExistsCheck[0];
            $building->setAmount($building->getAmount() + 1);
        }else{
            $building = new Building(
                $command->getId(),
                $template[0],
                $village,
                1,
                new \DateTime(),
                new \DateTime()
            );
        }

        $this->buildingRepo->persist($building);
    }
}
