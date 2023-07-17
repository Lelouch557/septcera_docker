<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\View\Screens;

use App\Infrastructure\Service\CurrentAdminService;
use App\View\SeptceraFunction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class VillageView extends AbstractController{
    use HandleTrait;

    public function __construct(
        private HttpClientInterface $client,
        private SeptceraFunction $functions
    ) {
    }
    public function __invoke(): Response {

        $chattablePlayers = $this->client->request(
            'GET',
            'http://minervia.nl/ownVillages',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => '*/*',
                    'Authorization' => $this->functions->getToken()
                ]
            ]
        );
        return $this->render('OverViews/VillageView.html.twig', ['chatters' => $chattablePlayers]);
    }
}
