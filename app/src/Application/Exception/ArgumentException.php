<?php

declare(strict_types=1);

namespace App\Application\Exception;

use App\Domain\Exception\ExceptionCodes;
use Exception;
use Throwable;

final class ArgumentException extends Exception 
{
    public function __construct(string $str)
    {
        parent::__construct(sprintf('%s', $str), ExceptionCodes::NOT_ENOUGH_PARAMETERS);
    }
}
