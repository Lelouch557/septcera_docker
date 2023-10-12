<?php

declare(strict_types=1);

namespace App\Application\Exception;

use App\Domain\Exception\ExceptionCodes;
use Exception;

final class EntityAlreadyExistsException extends Exception 
{
    public function __construct(string $entity, string $tagName)
    {
        parent::__construct(sprintf('%s %s already exists', $entity, $tagName), ExceptionCodes::ENTITY_ALREADY_EXISTS);
    }
}
