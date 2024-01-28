<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input;

use App\Application\Exception\ArgumentException;
use App\Infrastructure\DTO\Input\Validator;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
// use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Symfony\Component\Validator\Constraints as Assert;

final class GenericGetByParamsDTO {
    #[Assert\Type('string')]
    private $unitTemplate;

    #[Assert\Type('string')]
    private $village;

    #[Assert\Type('string')]
    private $amount;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $valid = false;
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);
        if (null == $data) {
            $data = $this->requestStack->getCurrentRequest()->attributes->get('parameters');
            $data = (array) json_decode($data);
        }
        $variables = [
            'unitTemplate',
            'village',
            'amount'
        ];

        foreach($variables as $var){
            $this->$var = (in_array($var, array_keys($data)))? $data[$var] : null;
        }

        foreach($variables as $var){
            if($this->$var != null){
                $valid = true;
            }
        }
        
        if(!$valid){
            throw new ArgumentException('One of unitTemplate, village, amount needs to be present.');
        }

        $this->DTOInterface->validate($this);
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
