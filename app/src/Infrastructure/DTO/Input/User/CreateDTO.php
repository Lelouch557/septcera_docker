<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input\User;

use App\Infrastructure\DTO\Input\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateDTO {
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $name;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $password;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $email;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);
        
        $this->name = $data['name'];
        $this->password = $data['password'];
        $this->email = $data['email'];

        $this->DTOInterface->validate($this);
    }

    public function getName() {
        return $this->name;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }
}
