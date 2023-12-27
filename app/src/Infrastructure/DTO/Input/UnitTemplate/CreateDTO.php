<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Infrastructure\DTO\Input\UnitTemplate;

use App\Infrastructure\DTO\Input\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateDTO {

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $name;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private int $offence;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private int $defense;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private int $hp;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);

        $this->name = $data['name'];
        $this->offence = $data['offence'];
        $this->defense = $data['defense'];
        $this->hp = $data['hp'];

        $this->DTOInterface->validate($this);
    }

    public function getName() {
        return $this->name;
    }

    public function getOffence() {
        return $this->offence;
    }

    public function getDefense() {
        return $this->defense;
    }

    public function getHp() {
        return $this->hp;
    }
}
