<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Action;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class HealthCheck {
    #[Route('/',
        name: 'api.healthcheck',
        methods: ['GET']
    )]
    public function __invoke(): JsonResponse {
        return new JsonResponse();
    }
}
