<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\ChatBericht;

use App\Application\Command\ChatBericht\GetSpecificCommand;
use App\Infrastructure\DTO\Output\ChatBericht\ChatBerichtOutputDTO;
use App\Application\Command\Chat\GetSpecificCommand as ChatCommand;
use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GetByChatId {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(string $id): JsonResponse {
        $id = Uuid::fromString($id);
        $data = $this->handle(new GetSpecificCommand([
            'chat' => $this->handle(new ChatCommand(['id' => $id]))[0]
        ]));

        $returnData = [];

        foreach ($data as $item) {
            $returnData[] = new ChatBerichtOutputDTO($item);
        }

        return new JsonResponse($returnData);
    }
}
