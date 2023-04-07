<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class Validator {
    public function __construct(
        private readonly RequestStack $requestStack,
        private ValidatorInterface $validator
    ) {
    }

    public function validate($DTO) {
        $request = $this->requestStack->getCurrentRequest();
        $errors = $this->validator->validate($DTO);

        if (count($errors) > 0) {
            /*
            * Uses a __toString method on the $errors variable which is a
            * ConstraintViolationList object. This gives us a nice string
            * for debugging.
            */
            $errorsString = (string) $errors;
            $conCat = explode('.', $errorsString);
            $errorArray = [];
            for ($i = 1; $i < count($conCat); $i += 2) {
                $a = explode(':', $conCat[$i]);
                array_push($errorArray, sprintf('Variable %s %s.', $a[0], substr($a[1], 15)));
            }
            $responseString = ['response' => $errorArray];
            $response = new JsonResponse(
                $responseString,
                501);
            $response->send();
        }
    }
}
