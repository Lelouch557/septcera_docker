<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Village;

use App\Application\Command\Village\CreateCommand;
use App\Application\Query\Village\SpecificQuery;
use App\Infrastructure\DTO\Input\Village\CreateDTO;
use App\Infrastructure\DTO\Input\Village\GetSpecificDTO;
use App\Infrastructure\DTO\Output\Village\SpecificOutputDTO;
use App\Infrastructure\Service\CurrentAdminService;
use App\Infrastructure\Validator\Validator;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

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
            $this->getSpecificDTO->getParameters(),
        )
        );

        $returnData = [];

        foreach ($data as $item) {
            $returnData[] = new SpecificOutputDTO($item);
        }

        return new JsonResponse($returnData);
    }
}
