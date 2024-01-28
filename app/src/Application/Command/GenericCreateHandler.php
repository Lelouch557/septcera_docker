<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command;

use App\Application\Exception\EntityAlreadyExistsException;
use App\Application\Exception\EntityDoesNotExistException;
use App\Domain\Model\Unit\Unit;
use App\Domain\Repository\GenericRepositoryInterface;
use DateTime;
use Exception;

class GenericCreateHandler{
    public function __construct(
        private GenericRepositoryInterface $genericRepository
    ) {
    }

    public function __invoke(GenericCreateCommand $query) {
        $modelPrefix = 'App\\Domain\\Model\\';
        $commandParameters = $query->getParameters();

        foreach($commandParameters as $key => $parameter){
            $type = (gettype($parameter) == 'object')? get_class($parameter) : gettype($parameter);
            
            if(
                $type == "Ramsey\Uuid\Lazy\LazyUuidFromString"
                && $key != 'id'
            ){
                $className = $modelPrefix . $key . '\\' . $key;
                $record = $this->genericRepository->pick($className, ['id' => $parameter]);

                if($record == null){
                    throw new EntityDoesNotExistException($key);
                }

                $commandParameters[$key] = $this->genericRepository->pick($className, ['id' => $parameter]);
            }
        }


        if($query->getExclusives() != null){
            if(
                !$this->checkIfExclusive($query->getClass(), $query->getExclusives())
                && $query->getAddOrCreate() != 'ADD'
            ){
                throw new EntityAlreadyExistsException($query->getClass(), '');
            }
        }

        ($query->getAddOrCreate() == 'ADD')? 
            $this->AddToRecord($query, $commandParameters) :
            $this->createNewRecord($query->getClass(), $commandParameters);
    }

    public function AddToRecord(GenericCreateCommand $query, array $commandParameters){
        $paramsExcludedFromUpdate = ['id', 'createdAt'];

        try{
            /** @var Unit */
            $record = $this->genericRepository->pick($query->getClass(), ['id' => $commandParameters['id']]);
        }catch(Exception $e){
            $record = null;
        }

        if($record == null){
            if($query->getExclusives() != null){
                $record = $this->genericRepository->pick($query->getClass(), $query->getExclusives());
                
                if($record == null){
                    $this->createNewRecord($query->getClass(), $commandParameters);
                    return;
                }
            }else{
                $this->createNewRecord($query->getClass(), $commandParameters);
                return;
            }
        }

        foreach($commandParameters as $key => $param){
            if(in_array($key, $paramsExcludedFromUpdate)){
                continue;
            }
            $functionNameSet = "set" . strtoupper(substr($key,0,1)) . substr($key, 1);
            $functionNameGet = "get" . strtoupper(substr($key,0,1)) . substr($key, 1);
            
            if(in_array($key, $query->getAdditives())){
                $record->$functionNameSet($param + $record->$functionNameGet());
                continue;
            }
            print_r($query->getExclusives());
            die;
            $record->$functionNameSet($param);
        }
        $this->genericRepository->set($record);
    }

    public function createNewRecord($class, $parameters){
        $record = new $class(
            $parameters['id'],
            $parameters['UnitTemplate'],
            $parameters['Village'],
            $parameters['amount'],
            new \DateTime(),
            new \DateTime()
        );
        
        $this->genericRepository->set($record);
    }
    
    public function checkIfExclusive($class, $exclusives) : bool{
        $record = $this->genericRepository->pick($class, $exclusives);
        return ($record == null)? true : false;
    }
}