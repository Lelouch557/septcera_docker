<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Village;

use App\Application\Command\Village\CreateCommand;
use App\Infrastructure\DTO\Input\Village\CreateDTO;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Create {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private CreateDTO $createDTO
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(): JsonResponse {
        $id = Uuid::uuid4();
        $this->handle(new CreateCommand(
            $id,
            $this->createDTO->getName(),
            $this->createDTO->getType(),
            $this->createDTO->getX(),
            $this->createDTO->getY()
        )
        );

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}
