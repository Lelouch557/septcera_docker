<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\View\Account;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;

class ForgotPassword extends AbstractController{
    use HandleTrait;

    public function __invoke(): Response {
    
        return $this->render('Account/ForgotPassword.html.twig');
    }

}
