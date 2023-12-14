<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Building;

use App\Application\Query\Building\SpecificQuery;
use App\Infrastructure\DTO\Input\Building\GetSpecificDTO;
use App\Infrastructure\DTO\Output\Building\SpecificOutputDTO;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GetByVillage {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $queryBus,
        private GetSpecificDTO $getByVillageDTO
    ) {
        $this->messageBus = $queryBus;
    }

    public function __invoke(): JsonResponse {
        $data = $this->handle(new SpecificQuery(
            id: null,
            template: null,
            village: $this->getByVillageDTO->getVillageId()
        ));

        $returnData = [];

        foreach ($data as $item) {
            $returnData[] = new SpecificOutputDTO($item);
        }

        return new JsonResponse($returnData);
    }
}
