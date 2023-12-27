<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Infrastructure\Action\UnitTemplate;
use App\Infrastructure\DTO\Input\UnitTemplate\CreateDTO;
use App\Application\Command\UnitTemplate\CreateCommand;
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
            $this->createDTO->getName(),
            $this->createDTO->getOffence(),
            $this->createDTO->getDefense(),
            $this->createDTO->getHp(),
        ));

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}
