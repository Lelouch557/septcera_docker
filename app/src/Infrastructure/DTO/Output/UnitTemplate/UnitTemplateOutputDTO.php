<?php

/*
 * This file is Copyright
 */

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Output\UnitTemplate;

use App\Domain\Model\UnitTemplate\UnitTemplate;

final class UnitTemplateOutputDTO implements \JsonSerializable {
    public function __construct(
        private UnitTemplate $unitTemplate
    ) {
    }

    public function getId(): string {
        return $this->unitTemplate->getId()->toString();
    }

    public function getName(){
        return $this->unitTemplate->getName();
    }
    
    public function getOffence(){
        return $this->unitTemplate->getOffence();
    }
    
    public function getDefense(){
        return $this->unitTemplate->getDefense();
    }
    
    public function getHp(){
        return $this->unitTemplate->getHp();
    }

    public function getCreatedAt(): string {
        return $this->unitTemplate->getCreatedAt()->format('c');
    }

    public function getUpdatedAt(): string {
        return $this->unitTemplate->getUpdatedAt()->format('c');
    }

    public function jsonSerialize(): mixed {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'offence' => $this->getOffence(),
            'defense' => $this->getDefense(),
            'hp' => $this->getHp(),
            'created_at' => $this->getCreatedAt(),
            'updated_at' => $this->getUpdatedAt(),
        ];
    }
}
