<?php

/*
 * This file is Copyright (c) - Move4Mobile B.V. (https://move4mobile.com)
 */

declare(strict_types=1);

namespace App\Application\Exception;

use App\Domain\Exception\ExceptionCodes;
use Exception;
use Throwable;

final class EntityAlreadyExistsException extends Exception 
{
    public function __construct(string $entity, string $tagName)
    {
        parent::__construct(sprintf('%s %s already exists', $entity, $tagName), ExceptionCodes::ENTITY_ALREADY_EXISTS);
    }
}
