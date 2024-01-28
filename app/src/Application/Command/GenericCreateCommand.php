<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command;

use Ramsey\Uuid\Uuid;

class GenericCreateCommand{

    public function __construct(
        private readonly string $addOrCreate,
        private readonly string $class,
        private readonly array $parameters,
        private readonly array $exclusives,
        private readonly array $additives
    ) {
    }

    public function getAddOrCreate(): string {
        return $this->addOrCreate;
    }

    public function getClass(): string {
        return $this->class;
    }

    public function getParameters(): array {
        return $this->parameters;
    }

    public function getExclusives(): array {
        return $this->exclusives;
    }

    public function getAdditives(): array {
        return $this->additives;
    }
}
