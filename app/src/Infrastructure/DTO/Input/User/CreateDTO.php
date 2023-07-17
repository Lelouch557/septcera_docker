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
    #[Assert\Length(
        min: 8,
        max: 500,
        minMessage: 'Passworda must be at least {{ limit }} characters long',
        maxMessage: 'cannot be longer than {{ limit }} characters',
    )]
    private $password;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[Assert\Regex(
        pattern: '/@/',
        match: true,
        message: 'Passworda must contain a "@"',
    )]
    #[Assert\Regex(
        pattern: '/.*\./',
        match: true,
        message: 'Passworda must contain a "."',
    )]
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
