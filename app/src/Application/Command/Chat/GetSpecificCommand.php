<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Chat;

use Ramsey\Uuid\UuidInterface;

class GetSpecificCommand {
    public function __construct(
        private readonly array $parameters
    ) {
    }

    public function getParameters(): array {
        return $this->parameters;
    }
}
