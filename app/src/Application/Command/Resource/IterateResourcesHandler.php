<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Resource;

use App\Domain\Model\Stockpile\Stockpile;
use App\Domain\Repository\BuildingRepositoryInterface;
use App\Domain\Repository\BuildingTemplateRepositoryInterface;
use App\Domain\Repository\GenericRepositoryInterface;
use App\Domain\Repository\VillageRepositoryInterface;
use DateTime;
use Symfony\Component\Messenger\HandleTrait;

class IterateResourcesHandler {
    use HandleTrait;

    public function __construct(
        private BuildingRepositoryInterface $buildingRepo,
        private BuildingTemplateRepositoryInterface $buildingTemplateRepo,
        private VillageRepositoryInterface $villageRepo,
        private GenericRepositoryInterface $stockpileRepo
        ) {
    }

    public function __invoke(IterateResourcesCommand $command): int {
        $amountUpdated = 0;
        $compareDate = new DateTime();
        
        $villages = $this->villageRepo->getSpecific([]);

        foreach($villages as $village){
            $buildings = $this->buildingRepo->get(['village' => $village]);

            foreach($buildings as $building){
                $buildingTemplates = $this->buildingTemplateRepo->get(['id' => $building->getBuilding()->getId()]);

                foreach($buildingTemplates as $buildingTemplate){

                    /** @var Stockpile */
                    $stockpile = $this->stockpileRepo->pick(Stockpile::class, [
                        'village' => $village->getId(),
                        'resource' => $buildingTemplate->getResource()
                    ]);

                    if($stockpile == NULL){
                        break;
                    }
                    $compared = $compareDate->diff($stockpile->getUpdatedAt());
                    $days = date_interval_format($compared, '%a');

                    if( $days < 1){
                        break;
                    }
                    $amountUpdated++;
                    $stockpile->setAmount($stockpile->getAmount() + ($buildingTemplate->getEffect() * $days));
                    $stockpile->setUpdatedAt();
                    $this->stockpileRepo->set($stockpile);
                }
            }
        }
        return $amountUpdated;
    }
}
