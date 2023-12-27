<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Infrastructure\DTO\Input\Unit;

use App\Infrastructure\DTO\Input\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class DeleteDTO {

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private string $id;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);

        $this->id = $data['id'];

        $this->DTOInterface->validate($this);
    }

    public function getId() {
        return $this->id;
    }
}
