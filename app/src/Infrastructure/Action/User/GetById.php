<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\User;

use App\Application\Command\User\GetSpecificCommand;
use App\Infrastructure\DTO\Output\User\UserOutputDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GetById {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(string $id): JsonResponse {
        $data = $this->handle(new GetSpecificCommand(['id' => $id]));

        $returnData = [];

        foreach ($data as $item) {
            $returnData[] = new UserOutputDTO($item);
        }

        return new JsonResponse($returnData);
    }
}
