<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Validator;

use App\Application\Command\User\CreateCommand;
use Doctrine\ORM\EntityManagerInterface;
use Error;
use Exception;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Console\Exception\MissingInputException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use TypeError;

class Validator
{
    const VALIDATION_TYPES = ['type', 'nullable', 'empty', 'choice'];

    public function __construct(
        private EntityManagerInterface $em
        ){
    }

    public function setRequest(Request $request){
        try{
            $this->request = $request;
            $this->data = (array) json_decode($request->getContent());
        }catch(Exception $e){
            throw new InvalidArgumentException('Invalid JSON body.');
        }
    }

    public function id($id = null, $class = null):UuidInterface{
        if($id){
            return ($this->em->getRepository($class)->findOneBy(['id' => $id]) !== null);
        }else{
            return Uuid::uuid4();
        }
    }

    public function __call($name, $arguments)
    {   
        $keys = array_keys($arguments);
        try{
            if(gettype($this->data[$name]) != $arguments['type'] ){
                throw new InvalidArgumentException(sprintf('%s needs to be of type %s.', $name, $arguments['type']));
            }
            if(in_array('nullable', $keys)){
                if(!$arguments['nullable']){
                    if ($this->data[$name] == null) throw new InvalidArgumentException(sprintf('%s cannot be null.', $name));
                }
            }
            if(in_array('empty', $keys)){
                if($arguments['empty']){
                    if(empty($this->data[$name])) throw new InvalidArgumentException(sprintf('%s cannot be empty.', $name));
                }
            }
            if(in_array('choice', $keys)){
                if(!in_array($this->data[$name], $arguments['choice'])) throw new InvalidArgumentException(sprintf('%s is not accepted.', json_encode($this->data[$name])));
            }
        }catch(TypeError $e){
            throw new InvalidArgumentException(sprintf('%s produced type error', $name));
        }
        catch(InvalidArgumentException $e){
            throw $e;
        }
        catch(Error $e){
            print_r($name);
            exit;
        }
        
        return $this->data[$name];
    }
}