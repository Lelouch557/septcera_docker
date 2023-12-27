<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input\UnitTemplate;

use App\Infrastructure\DTO\Input\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class GetSpecificDTO {
    #[Assert\NotBlank]
    #[Assert\Type('array')]
    private $parameters;

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

        $this->parameters = (array) $data['parameters'];

        $this->DTOInterface->validate($this);
    }

    public function getParameters() {
        return $this->parameters;
    }
}
