<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Infrastructure\Action\Unit;
use App\Infrastructure\DTO\Input\Unit\CreateDTO;
use App\Application\Command\Unit\CreateCommand;
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
        $dat = $this->handle(new CreateCommand(
            $id,
            Uuid::fromString($this->createDTO->getUnitTemplate()),
            Uuid::fromString($this->createDTO->getVillage()),
            $this->createDTO->getAmount(),
        ));

        return new JsonResponse(['id' => $dat], Response::HTTP_OK);
    }
}
