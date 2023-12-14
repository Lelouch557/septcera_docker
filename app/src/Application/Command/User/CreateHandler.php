<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\User;

use App\Application\Command\Village\CreateCommand as VillageCreateCommand;
use App\Application\Exception\EntityAlreadyExistsException;
use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use Doctrine\ORM\Query\Expr\Math;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Range;

class CreateHandler {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private UserRepositoryInterface $repo,
        private UserPasswordHasherInterface $passwordHasher
        ) {
            $this->messageBus = $messageBus;
    }

    public function __invoke(CreateCommand $command): void {
        $existingParams = [];

        $existingUserByName = $this->repo->getSpecific(['name' => $command->getUserName()]);
        if ($existingUserByName) {
            array_push($existingParams, "user_name");
        }

        $existingUserByMail = $this->repo->getSpecific(['email' => $command->getEmail()]);
        if ($existingUserByMail) {
            array_push($existingParams, " email");
        }

        if($existingParams){
            $msg = "";
            foreach($existingParams as $param){
                $msg .= $param;
            }
            throw new EntityAlreadyExistsException("User", $msg);
        }

        $user = new User(
            $command->getId(),
            $command->getUserName(),
            $command->getPassword(),
            $command->getEmail(),
            $command->getConfirmationKey(),
            $command->getStatus(),
            $command->getRoles(),
            new \DateTime(),
            new \DateTime()
        );

        $user->setPassword($this->passwordHasher->hashPassword($user, $command->getPassword()));
        $this->repo->persist($user);

        $this->handle(new VillageCreateCommand(
            Uuid::uuid4(),
            $user,
            $this->createName(),
            "city",
            0,
            0
        ));
    }
    private function createName(){
        $klinker = ['a','e','i','o','u'];
        $medeKlinker = [ 'b','c','d','f','g','h','j','k','l','m','p','q','r','s','t','v','w','x','y','z'];
        $letterTypes = [$medeKlinker, $klinker];
        $word = "";

        $itteration = 0;
        $itterated = False;
        $wordLength =  random_int(3,random_int(4,15));

        for($itteration = 0; $itteration < $wordLength; $itteration++){
            if($itteration % 2 == 1 && !$itterated){
                $rnd = random_int(0, 10);
                if ($rnd > 5){
                    $itterated = True;
                    $itteration -= 1;
                    $word = $word . $letterTypes[0][random_int(0, 19)];
                    continue;
                }
            }

            $itterated = False;
            $arr = $letterTypes[$itteration % 2];
            $word = $word . $arr[random_int(0,count($arr)-1)];
        }
        return $word;
    }
}
