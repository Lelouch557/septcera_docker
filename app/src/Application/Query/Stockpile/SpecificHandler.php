<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query\Stockpile;

use App\Application\Exception\EntityDoesNotExistException;
use App\Domain\Model\Resource\Resource;
use App\Domain\Model\Stockpile\Stockpile;
use App\Domain\Model\Village\Village;
use App\Domain\Repository\GenericRepositoryInterface;

class SpecificHandler {
    public function __construct(
        private GenericRepositoryInterface $stockpileRepo,
        private GenericRepositoryInterface $resourceRepo,
        private GenericRepositoryInterface $villageRepo
    ) {
    }

    public function __invoke(SpecificQuery $query) {
        $parameters = $query->getParameters();
        
        if(isset($parameters['resource'])){
            $resource = $this->stockpileRepo->pick(Resource::class, ['id'=>$parameters['resource']]);

            if($resource){
                $parameters['resource'] = $resource;
            }else{
                throw new EntityDoesNotExistException('Resource does not exist');
            }
        }
        
        if(isset($parameters['village'])){
            $village = $this->stockpileRepo->pick(Village::class, ['id'=>$parameters['village']]);

            if($village){
                $parameters['village'] = $village;
            }else{
                throw new EntityDoesNotExistException('Village does not exist');
            }
        }
        
        return $this->stockpileRepo->get(Stockpile::class, $parameters);
    }
}
