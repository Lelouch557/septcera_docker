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

class TestViesdfw extends AbstractController{
    use HandleTrait;
    
    public function __construct(
        private HttpClientInterface $client,
        private CurrentAdminService $adminService
    ) {
    }

    function getToken(){
    }

    public function __invoke(RequestStack $requestStack): Response {
        $requestString = $requestStack->getCurrentRequest()->__toString();
        $token = explode(";", explode("\r",explode('token=', explode('Cookie:', $requestString)[1])[1])[0])[0];
        
        if(!$token){
            return new JsonResponse(['Response'=>'Something went wrong please send this code to the helpdesk: 7289304']);
        }
        
        // try{
            $bearerToken = 'Bearer ' . $token;
            
            $response = $this->client->request(
                'GET',
                'http://minervia.nl/ownVillages',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => '*/*',
                        'Authorization' => $bearerToken
                    ]
                ]
            );
            
            $village = (array)json_decode($response->getContent())[0];

            $user = $this->adminService->getCurrentUser($token);

            return $this->render('Test.html.twig', [
                'city_type' => $village['type'], 
                'name' => $village['type'], 
                'coords' => $village['x'] . ", ". $village['y'],
                'user_name' => $user->getName(),
                'players' => [
                    ['name'=>'Iabamun'],
                    ['name'=>'Septcera'],
                    ['name'=>'Ryhox'],
                    ['name'=>'Silversword'],
                    ['name'=>'Lelouch557'],
                    ['name'=>'Minervia']
                ]
            ]);
        // }catch(ClientException $e){
        //     return $this->render('Error/500.html.twig');
        // }
    }
}
