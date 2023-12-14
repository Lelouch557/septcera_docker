<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Building;

use App\Application\Command\Building\CreateCommand;
use App\Infrastructure\DTO\Input\Building\CreateDTO;
use App\Infrastructure\Service\CurrentAdminService;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Create {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private CurrentAdminService $currentAdminService,
        private CreateDTO $createDTO
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(): JsonResponse {
        $id = Uuid::uuid4();
        $this->handle(new CreateCommand(
            $id,
            $this->createDTO->getBuilding(),
            $this->createDTO->getVillageId()
        ));

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}
