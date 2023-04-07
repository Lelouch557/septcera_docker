<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Service;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class DTO {
    public function __construct(
        private readonly RequestStack $requestStack
    ) {
    }
}
