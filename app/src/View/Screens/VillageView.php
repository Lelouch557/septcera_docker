<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\View\Screens;

use App\Domain\Model\Stockpile\Stockpile;
use App\Infrastructure\Service\CurrentAdminService;
use App\View\SeptceraFunction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
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
        $token = 'Bearer ' . trim($this->functions->getToken());

        $villageInfo = $this->client->request(
            'GET',
            'http://minervia.nl/ownVillages',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => '*/*',
                    'Authorization' => $token
                ]
            ]
        );
        $villageInfo = (array) json_decode($villageInfo->getContent())[0];

        $buildingsJSON = $this->client->request(
            'GET',
            'http://minervia.nl/buildingByVillage',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => '*/*',
                    'Authorization' => $token
                ],
                'body' => json_encode(["village_id" => $villageInfo['id']])
            ]
        );

        $buildings = (array) json_decode($buildingsJSON->getContent());

        $stockpileJSON = $this->client->request(
            'GET',
            'http://minervia.nl/stockpile',
            [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Accept' => '*/*',
                    'Authorization' => $token
                ],
                'body' => json_encode(["village_id" => $villageInfo['id']])
            ]
        );
        $stockpile = [];

        $worldSize = 30;
        $developed = $this->getDevelopment($buildings);
        $districtAmount = min(21, $worldSize);
        
        foreach((array)json_decode($stockpileJSON->getContent()) as $res){
            $res = (array)$res;
            $stockpile[$res['resource']] = $res;
        }
        return $this->render('OverViews/PlanetView/Main.html.twig', [
            'name' => $villageInfo['name'],
            'players' => [],
            'districts' => $this->orderBuildings($buildings),
            'developed' => $developed,
            'size' => $worldSize,
            'districtAmount' => $districtAmount,
            'id' => $villageInfo['id'],
            'stockpile' => $stockpile
        ]);
    }

    private function getDevelopment($buildings){
        $dev = 0;
        foreach($buildings as $building){

            $building = ((array)$building);
            $dev += $building['amount'];
        }
        return $dev;
    }

    private function orderBuildings($buildings){
        $dict = [
            'city' => 0,
            'energy' => 0,
            'research' => 0,
            'entertainment' => 0,
            'agriculture' => 0,
            'minerals' => 0,
            'military' => 0 
        ];
        
        foreach($buildings as $b){
            $b = (array) $b;
            $dict[(string)$b['type']] = $b['amount'];
        }
        return $dict;
    }
}
