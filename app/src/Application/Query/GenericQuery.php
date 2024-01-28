<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class GenericQuery{
    private array $params;

    public function __construct(
        private readonly string $class,
        ...$query
    ) {
        $this->params = $query;
    }

    public function getClass(): string {
        $returnString = 'App\\Domain\\Model\\' . $this->class . '\\' . $this->class;
        return $returnString;
    }

    public function getParameters(): array {
        $ret = [];

        foreach($this->params as $item){
            foreach($item as $key => $val){
                if($val){
                    $ret[$key] = $val;
                }
            }
        }
        
        return $ret;
    }
}
