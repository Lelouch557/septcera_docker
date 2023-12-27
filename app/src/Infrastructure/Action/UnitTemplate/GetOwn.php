<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\UnitTemplate;

use App\Application\Command\Resource\IterateResourcesCommand;
use App\Application\Command\User\IterateResourcesHandler;
use App\Application\Query\Village\SpecificQuery;
use App\Infrastructure\DTO\Input\Village\GetSpecificDTO;
use App\Infrastructure\DTO\Output\Village\SpecificOutputDTO;
use App\Infrastructure\Service\CurrentAdminService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GetOwn {
    use HandleTrait;

    public function __construct(
        private MessageBusInterface $queryBus,
        private MessageBusInterface $commandBus,
        private CurrentAdminService $currentAdminService
    ) {
    }

    public function __invoke(): JsonResponse {
        $this->messageBus = $this->commandBus;
        $a = $this->handle(new IterateResourcesCommand());
        
        $this->messageBus = $this->queryBus;

        $data = $this->handle(new SpecificQuery(
            ["user" => $this->currentAdminService->getCurrentUser()]
        ));

        $returnData = [];

        foreach ($data as $item) {
            $returnData[] = new SpecificOutputDTO($item);
        }

        return new JsonResponse($returnData);
    }
}