<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\View;

use App\Infrastructure\Service\CurrentAdminService;
use Error;
use ErrorException;
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
        private CurrentAdminService $adminService,
        private RequestStack $stack
    ) {
    }

    function getToken():string{
        $this->unstack();
        return $this->token;
    }

    function unstack(){
        $requestString = $this->stack->getCurrentRequest()->__toString();
        $autho = explode('Authorization:', $requestString);
        $token = false;
        try{
            if(count($autho) > 1){
                $token = trim(explode('Connection',trim(explode('Bearer', $requestString)[1]))[0]);
            }else{
                $token = (
                    trim(
                        explode(
                            ';', trim(
                                explode(
                                    'token=', $requestString
                                )[1]
                            )
                        )[0]
                    )
                );
            }
        }
        catch(ErrorException $e){}
        
        if(!$token){
            echo 'Something went wrong please send this code to the helpdesk: 891321053';
            die;
        }else{
            $this->token = $token;
        }
    }
}
