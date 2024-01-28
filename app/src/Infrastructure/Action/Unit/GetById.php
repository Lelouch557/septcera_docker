<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Unit;

use App\Application\Query\GenericQuery;
use App\Infrastructure\DTO\Input\GenericGetByIdDTO;
use App\Infrastructure\DTO\Output\User\UserOutputDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GetById {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $queryBus,
        private GenericGetByIdDTO $genericGetByIdDTO
    ) {
        $this->messageBus = $queryBus;
    }

    public function __invoke(): JsonResponse {
        $data = $this->handle(new GenericQuery(
            'Unit',
            ['id' => $this->genericGetByIdDTO->getId()]
        ));
        $returnData = new UserOutputDTO($data);
        
        return new JsonResponse($returnData);
    }
}
