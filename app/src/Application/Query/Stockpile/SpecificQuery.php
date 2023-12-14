<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query\Stockpile;

use Faker\Core\Uuid;
use Ramsey\Uuid\UuidInterface;

class SpecificQuery {
    public function __construct(
        private readonly ?string $id = null,
        private readonly ?string $resource_id = null,
        private readonly ?string $village_id = null
    ) {
    }

    public function getParameters(): array {
        $returnArray = [];

        if($this->id != null){
            $returnArray['id'] = $this->id;
        }
        if($this->resource_id != null){
            $returnArray['resource'] = $this->resource_id;
        }
        if($this->village_id != null){
            $returnArray['village'] = $this->village_id;
        }

        return $returnArray;
    }
}
