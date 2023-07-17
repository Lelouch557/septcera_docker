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
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

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
            $user->getName() . "'s village",
            "city",
            0,
            0
        ));
    }
}
