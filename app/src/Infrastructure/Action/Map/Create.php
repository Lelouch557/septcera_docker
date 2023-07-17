<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Map;

use App\Application\Command\Map\CreateCommand;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Create {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(): JsonResponse {
        $this->handle(new CreateCommand());

        return new JsonResponse(['id' => "success"], Response::HTTP_OK);
    }
}
