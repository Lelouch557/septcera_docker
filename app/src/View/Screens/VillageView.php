<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\View\Screens;

use App\Domain\Repository\VillageRepositoryInterface;
use App\Infrastructure\Persistence\Doctrine\ORM\Repository\VillageRepository;
use App\Infrastructure\Service\CurrentAdminService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;

class VillageView {
    use HandleTrait;
    
    public function __invoke(): Response {
        $html = '
            <body>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
                <style>
                    body{
                        background-color: #f4faff;
                    }
                    form{
                        display: grid;
                    }
                    .login{
                        width: 20%;
                        position: absolute;
                        padding: 1em;
                        padding-bottom: 0;
                        box-shadow: 0 0 50px 0px #b8b8b84f;
                        left: 40%;
                        top: 40%;
                        background-color: white;
                        border-radius: 8px;
                    }
                </style>

                <form class="login">
                    <div><label>type: </label><label id="type"></label></div>
                    <div><label>name: </label><label id="name"></label></div>
                    <div><label>coordinates: </label><label id="coordinates"></label></div>
                </div>


                <script>
                    let token = document.cookie;
                    token = JSON.parse(token)["access_token"];
                    token = "Bearer " + token;

                    $.ajax({
                        url: "http://127.0.0.1:8080/village/{ \"parameters\": {\"user\": \"67188c46-8edf-40c4-8df3-3927828735f7\"}}", 
                        headers: {
                            "Authorization": token,
                            "Content-Type": "application/json"
                        },
                        method: "GET",
                        success: function(data){
                            // $("#type").html(data[0].type);
                            // $("#name").html(data[0].name);
                            // $("#coordinates").html(data[0].x + ", " + data[0].y);
                        }
                    }).always(function(data) {
                        if(data.status != 200){
                            window.location.href = "http://127.0.0.1:8080/login";
                        }
                    }
                </script>
            </body>';

        echo $html;
        return new Response();
    }
}

