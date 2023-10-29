<?php

/*
 * mine -André
 */

namespace App\Domain\Model\Stockpile;

use App\Domain\Model\DatabaseEntry\DatabaseEntry;
use App\Domain\Model\Resource\Resource;
use App\Domain\Model\User\User;
use App\Domain\Model\Village\Village;
use Ramsey\Uuid\UuidInterface;

class db{
    public function __toString()
    {
        return 'adf';
    }
} 

class Stockpile extends DatabaseEntry{
    public function __construct(
        private UuidInterface $id,
        private Village $village,
        private Resource $resource,
        private int $amount,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }
    
    public function getVillage(): Village{
        return $this->village;
    }

    public function getResource(): Resource{
        return $this->resource;
    }

    public function getAmount(): int{
        return $this->amount;
    }

    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }
    
    
    public function setVillage(Village $village): Village{
        return $this->village = $village;
    }
    
    public function setResource(Resource $resource): Resource{
        return $this->resource = $resource;
    }

    public function setAmount(int $amount): int{
        return $this->amount = $amount;
    }

    public function setUpdatedAt(): void {
        $this->updatedAt = new \DateTime();
    }

    public function __toString()
    {
        return printf('
    id = %s, 
    village = %s, 
    resource = %s, 
    amount = %s, 
    createdAt = %s, 
    updatedAt = %s
            ',
            $this->id,
            $this->village->getId(),
            $this->resource->getName(),
            $this->amount,
            $this->createdAt->format('c'),
            $this->updatedAt->format('c')
        );
    }
}
