<?php

declare(strict_types=1);

namespace App\Application\Exception;

use App\Domain\Exception\ExceptionCodes;
use Exception;
use Throwable;

final class EntityDoesNotExistException extends Exception 
{
    public function __construct(string $entity)
    {
        parent::__construct(sprintf('%s does not exist.', $entity), ExceptionCodes::ENTITY_DOES_NOT_EXIST);
    }
}
