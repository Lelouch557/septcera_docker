<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query\Building;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class SpecificQuery{
    public function __construct(
        private readonly ?string $id = null,
        private readonly ?string $template = null,
        private readonly ?string $village = null
    ) {
    }

    public function getParameters(): array {
        $ret = [];

        foreach(get_object_vars($this) as $key => $val){
            if($val){
                $ret[$key] = $val;
            }
        }
        
        return $ret;
    }
}
