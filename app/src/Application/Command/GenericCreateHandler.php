<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command;

use App\Application\Exception\EntityAlreadyExistsException;
use App\Application\Exception\EntityDoesNotExistException;
use App\Domain\Model\Unit\Unit;
use App\Domain\Model\User\User;
use App\Domain\Repository\GenericRepositoryInterface;
use DateTime;
use Exception;

class GenericCreateHandler{
    public function __construct(
        private GenericRepositoryInterface $genericRepository
    ) {
    }

    public function __invoke(GenericCreateCommand $command) {
        $modelPrefix = 'App\\Domain\\Model\\';
        $commandParameters = $command->getParameters();
        $this->relationsAreValid($command);
        // if($command->getExclusives() != null){
        //     if(
        //         !$this->checkIfExclusive($command->getClass(), $command->getExclusives())
        //         && $command->getAddOrCreate() != 'ADD'
        //     ){
        //         throw new EntityAlreadyExistsException($command->getClass(), '');
        //     }
        // }

        // ($command->getAddOrCreate() == 'ADD')? 
        //     $this->AddToRecord($command, $commandParameters) :
        //     $this->createNewRecord($command->getClass(), $commandParameters);
    }

    public function relationsAreValid(GenericCreateCommand $command): bool{
        $commandParameters = $command->getParameters();

        foreach($commandParameters as $key => $parameter){
            if( !$this->isRelation($key, $parameter)){
                continue;
            }
            
            print_r( gettype($parameter));
        }
        die;
        return false;
    }

    public function isRelation($key, $parameter): bool{
        if(gettype($parameter) != 'object'){
            return false;
        }
        
        if(get_class($parameter) != 'Ramsey\Uuid\Lazy\LazyUuidFromString'){
            return false;
        }

        if($key == 'id'){
            return false;
        }
        
        return true;
    }

    public function AddToRecord(GenericCreateCommand $query, array $commandParameters){

        $this->recordsExists([User::class => '03082dee-5dd1-4ac2-a905-fa068b90e69e']);
        // $paramsExcludedFromUpdate = ['id', 'createdAt'];

        // try{
        //     /** @var Unit */
        //     $record = $this->genericRepository->pick($query->getClass(), ['id' => $commandParameters['id']]);
        // }catch(Exception $e){
        //     $record = null;
        // }

        // if($record == null){
        //     if($query->getExclusives() != null){
        //         $record = $this->genericRepository->pick($query->getClass(), $query->getExclusives());
                
        //         if($record == null){
        //             $this->createNewRecord($query->getClass(), $commandParameters);
        //             return;
        //         }
        //     }else{
        //         $this->createNewRecord($query->getClass(), $commandParameters);
        //         return;
        //     }
        // }

        // foreach($commandParameters as $key => $param){
        //     if(in_array($key, $paramsExcludedFromUpdate)){
        //         continue;
        //     }
        //     $functionNameSet = "set" . strtoupper(substr($key,0,1)) . substr($key, 1);
        //     $functionNameGet = "get" . strtoupper(substr($key,0,1)) . substr($key, 1);
            
        //     if(in_array($key, $query->getAdditives())){
        //         $record->$functionNameSet($param + $record->$functionNameGet());
        //         continue;
        //     }
        //     print_r($query->getExclusives());
        //     die;
        //     $record->$functionNameSet($param);
        // }
        // $this->genericRepository->set($record);
    }

    public function recordsExists(array $records): bool{
        foreach($records as $key => $value){
        
            print_r($record = $this->genericRepository->get($key,['status'=>'Active']));
        }

        return True;
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