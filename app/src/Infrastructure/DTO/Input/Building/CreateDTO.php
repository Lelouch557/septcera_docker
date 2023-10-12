<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input\Building;

use App\Infrastructure\DTO\Input\Validator;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateDTO {
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $building_id;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $village_id;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);

        try{
            $this->building_id = $data['building_id'];
            $this->village_id = $data['village_id'];
        }catch(Exception $e){}

        $this->DTOInterface->validate($this);
    }

    public function getBuildingId() {
        return Uuid::fromString($this->building_id);
    }

    public function getVillageId() {
        return Uuid::fromString($this->village_id);
    }
}
