<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query\Village;

use App\Domain\Model\User\User;
use Ramsey\Uuid\UuidInterface;

class SpecificQuery { 
    public function __construct(
        private readonly array $parameters
    ) {
    }

    public function getParameters(): array {
        return $this->parameters;
    }
}
