<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Validator;

use App\Application\Command\User\CreateCommand;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Exception\MissingInputException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use TypeError;

class Validator
{
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

    public function id($id = null, $class = null){
        if($id){
            return ($this->em->getRepository($class)->findOneBy(['id' => $id]) !== null);
        }else{
            return Uuid::uuid4();
        }
    }

    // type, null, empty, choice
    public function __call($name, $arguments)
    {   
        print_r($arguments);
        exit();
        try{
            if(gettype($this->data[$name]) == $arguments['type'] ){
                print_r($this->data[$name]);
                exit();
            }
        }catch(TypeError $e){
            throw new InvalidArgumentException('Invalid JSON body.');
        }
        exit('dsfg');
        
        print_r($name);

        exit();
    }
}