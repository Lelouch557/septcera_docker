<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\View;

use App\Infrastructure\Service\CurrentAdminService;
use Error;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class SeptceraFunction {
    use HandleTrait;    
    private string $token = '';

    public function __construct(
        private CurrentAdminService $adminService
    ) {
    }

    function getToken():string{
        return $this->token;
    }

    public function __invoke(RequestStack $requestStack): Response {
        $requestString = $requestStack->getCurrentRequest()->__toString();
        $token = explode(";", explode("\r",explode('token=', explode('Cookie:', $requestString)[1])[1])[0])[0];
        
        if(!$token){
            return new JsonResponse(['Response'=>'Something went wrong please send this code to the helpdesk: 7289304']);
        }else{
            $this->token = $token;
        }
    }
}
