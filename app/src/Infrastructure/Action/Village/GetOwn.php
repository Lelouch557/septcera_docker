<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Village;

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
        MessageBusInterface $queryBus,
        CurrentAdminService $currentAdminService
    ) {
        $this->currentAdminService = $currentAdminService;
        $this->messageBus = $queryBus;
    }

    public function __invoke(): JsonResponse {
    // print_r($this->currentAdminService->getCurrentUser());
    // die;
        $data = $this->handle(new SpecificQuery(
            ["user" => $this->currentAdminService->getCurrentUser()]
        )
        );

        $returnData = [];

        foreach ($data as $item) {
            $returnData[] = new SpecificOutputDTO($item);
        }

        return new JsonResponse($returnData);
    }
}
// basis kosten incl. BTW
// server - door klant bepaald
// slim - 95 | 8p/m
// plus - 190 | 16p/m
// pro - 385 |  33p/m

// URL - Verschilt.
// ~11 | 1 p/m

// werk geleverd - door minervia bepaald
// slim - (200) 405 | 34p/m
// plus - (400) 817 | 69p/m
// pro - (600) 1225 | 103p/m

// S = slim A = plus B = pro U = URL
// SSU = 511 | 43 p/m
// SAU = 934 | 78 p/m
// SBU = 1231 |  112 p/m
// ASU = 606 | 51 p/m
// AAU = 1018 | 86 p/m
// ABU = 1426 | 120 p/m
// BSU = 801 | 68 p/m
// BAU = 1213 | 103 p/m
// BBU = 1621 | 137 p/m
