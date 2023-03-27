<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input\Village;

use App\Infrastructure\DTO\Input\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class CreateDTO
{

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private $text;

    #[Assert\NotBlank]
    #[Assert\Choice(['city'])]
    private $type;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private $x;

    #[Assert\NotBlank]
    #[Assert\Type('integer')]
    private $y;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ){
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);

        $this->text = $data['text'];
        $this->type = $data['type'];
        $this->x = $data['x'];
        $this->y = $data['y'];

        $this->DTOInterface->validate($this);
    }
    
    public function getName(){
        return $this->text;
    }
    
    public function getType(){
        return $this->type;
    }
    
    public function getX(){
        return $this->x;
    }
    
    public function getY(){
        return $this->y;
    }
}