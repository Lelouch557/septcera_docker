<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Stockpile;

// use App\Application\Query\Village\SpecificQuery;
// use App\Infrastructure\DTO\Input\Village\GetSpecificDTO;
// use App\Infrastructure\DTO\Output\Village\SpecificOutputDTO;

use App\Application\Query\Stockpile\SpecificQuery;
use App\Infrastructure\DTO\Input\Stockpile\GetSpecificDTO;
use App\Infrastructure\DTO\Output\Stockpile\SpecificOutputDTO;
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
            $this->getSpecificDTO->getId(),
            $this->getSpecificDTO->getResouceId(),
            $this->getSpecificDTO->getVillageId()
        )
        );

        $returnData = [];

        foreach ($data as $item) {
            $returnData[] = new SpecificOutputDTO($item);
        }

        return new JsonResponse($returnData);
    }
}
