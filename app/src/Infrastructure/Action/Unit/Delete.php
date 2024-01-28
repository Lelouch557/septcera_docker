<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Infrastructure\Action\Unit;
use App\Infrastructure\DTO\Input\Unit\DeleteDTO;
use App\Application\Command\Unit\DeleteCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Delete {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private DeleteDTO $deleteDTO
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(): JsonResponse {
        $dat = $this->handle(new DeleteCommand(
            Uuid::uuid4($this->deleteDTO->getId())
        ));

        return new JsonResponse(['response' => 'Successfully deleted'], Response::HTTP_OK);
    }
}
