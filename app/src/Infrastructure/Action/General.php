<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Action;

use App\Application\Command\GenericCreateCommand;
use App\Domain\Model\Chat\Chat;
use App\Domain\Model\User\User;
use DateTime;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class General {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }
    public function __invoke(): JsonResponse {
        $this->handle(new GenericCreateCommand('add', User::class, [
            'date' => new DateTime(),
            Chat::class => Uuid::fromString('03082dee-5dd1-4ac2-a905-fa068b90e69e'),
            
        ]));

        return new JsonResponse();
    }
}
