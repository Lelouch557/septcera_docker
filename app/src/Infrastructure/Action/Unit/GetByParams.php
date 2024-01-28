<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Unit;

use App\Application\Query\GenericQuery;
use App\Infrastructure\DTO\Input\GenericGetByParamsDTO;
use App\Infrastructure\DTO\Output\User\UserOutputDTO;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GetByParams {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $queryBus,
        private GenericGetByParamsDTO $genericGetByParamsDTO
    ) {
        $this->messageBus = $queryBus;
    }

    public function __invoke(): JsonResponse {
        $parameters = [];
        ($this->genericGetByParamsDTO->getUnitTemplate() != null)? $parameters['unitTemplate'] = $this->genericGetByParamsDTO->getUnitTemplate() : null;
        ($this->genericGetByParamsDTO->getVillage() != null)? $parameters['Village'] = $this->genericGetByParamsDTO->getVillage() : null;
        ($this->genericGetByParamsDTO->getAmount() != null)? $parameters['amoutn'] = $this->genericGetByParamsDTO->getAmount() : null;

        $data = $this->handle(new GenericQuery(
            "Unit",
            []
        ));

        $returnData = new UserOutputDTO($data);
        
        return new JsonResponse($returnData);
    }
}
