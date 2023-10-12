<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Building;

use App\Application\Query\Building\SpecificQuery;
use App\Infrastructure\DTO\Input\Building\GetSpecificDTO;
use App\Infrastructure\DTO\Output\Building\SpecificOutputDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GetSpecific {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $queryBus,
        private GetSpecificDTO $getSpecificDTO
    ) {
        $this->messageBus = $queryBus;
    }

    public function __invoke(): JsonResponse {
        $data = $this->handle(new SpecificQuery(
            $this->getSpecificDTO->getBuildingId(),
            $this->getSpecificDTO->getTemplateId(),
            $this->getSpecificDTO->getVillageId(),
        ));

        $returnData = [];

        foreach ($data as $item) {
            $returnData[] = new SpecificOutputDTO($item);
        }

        return new JsonResponse($returnData);
    }
}
