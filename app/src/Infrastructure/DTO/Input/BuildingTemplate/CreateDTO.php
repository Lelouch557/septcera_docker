<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input\BuildingTemplate;

use App\Infrastructure\DTO\Input\Validator;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateDTO {
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $name;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $effect;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);

        try{
            $this->name = $data['name'];
            $this->effect = $data['effect'];
        }catch(Exception $e){}

        $this->DTOInterface->validate($this);
    }

    public function getBuildingId() {
        return Uuid::fromString($this->name);
    }

    public function getVillageId() {
        return Uuid::fromString($this->effect);
    }
}
