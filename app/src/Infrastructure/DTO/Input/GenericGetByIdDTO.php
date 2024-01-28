<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input;

use App\Infrastructure\DTO\Input\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class GenericGetByIdDTO {
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $id;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);
        if (null == $data) {
            $data = $this->requestStack->getCurrentRequest()->attributes->get('parameters');
            $data = (array) json_decode($data);
        }
        $this->id = (in_array('id', array_keys($data)))? $data['id'] : null;

        $this->DTOInterface->validate($this);
    }

    public function getId() {
        return $this->id;
    }
}
