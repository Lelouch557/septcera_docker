<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Infrastructure\DTO\Input\Unit;

use App\Infrastructure\DTO\Input\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class UpdateDTO {

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $id;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $unitTemplate;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $village;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private int $amount;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);

        $this->id = $data['id'];
        $this->unitTemplate = $data['unitTemplate'];
        $this->village = $data['village'];
        $this->amount = $data['amount'];

        $this->DTOInterface->validate($this);
    }

    public function getId() {
        return $this->id;
    }

    public function getUnitTemplate() {
        return $this->unitTemplate;
    }

    public function getVillage() {
        return $this->village;
    }

    public function getAmount() {
        return $this->amount;
    }
}
