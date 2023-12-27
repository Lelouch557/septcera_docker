<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Infrastructure\Action\Unit;

use App\Infrastructure\DTO\Input\Unit\UpdateDTO;
use App\Application\Command\Unit\UpdateCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Update {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private UpdateDTO $updateDTO
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(): JsonResponse {
        $dat = $this->handle(new UpdateCommand(
            Uuid::uuid4($this->updateDTO->getId()),
            $this->updateDTO->getAmount(),
        ));

        return new JsonResponse(['response' => 'Successfully updated'], Response::HTTP_OK);
    }
}
