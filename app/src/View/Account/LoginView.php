<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\View\Account;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;

class LoginView {
    use HandleTrait;

    public function __invoke(): Response {
        $html = '
            <body>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
                <style>
                    body{
                        background-image: url("Naamloos.png");
                        background-color: #f4faff;
                    }
                    form{
                        display: grid;
                    }
                    .button{
                        padding: 0.5em;
                        cursor: pointer;
                        margin-top: 15px;
                        border: 0px;
                        background-color: #009dff;
                        border-radius: 7px;
                        color: white;
                        align-self: center;
                        width: 20%;
                        margin-left: 40%;
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
                    .login-input{
                        display: block;
                        width: 100%;
                        padding: 0.333rem 0.75rem;
                        font-size: 1rem;
                        margin-bottom: 0.2em;
                        font-weight: 400;
                        line-height: 1.5;
                        color: #2f2f3f;
                        background-color: #fff;
                        background-clip: padding-box;
                        border: 1px solid #bbbccc;
                        -webkit-appearance: none;
                        -moz-appearance: none;
                        appearance: none;
                        border-radius: 0.3rem;
                        transition: border-color .18s ease-in-out,box-shadow .18s ease-in-out;
                    }
                    .login-input:focus{
                        background-color: #fff;
                        outline: 0;
                        box-shadow: 0 0 0 0.25rem rgba(0,103,255,.25);
                    }
                </style>

                <div class="login">
                    <form>
                        <input class="login-input" type="text" id="user_name" placeholder="username"/>
                        <input class="login-input" type="password" id="password" placeholder="password"/>
                        <input class="button" type="button" value="Login" onclick="login()"/>
                    </form>
                </div>

                <script>
                    function login(){
                        let link = String("http://" + (window.location.href).split("/")[2]);
                        let user_name = $("#user_name").val();
                        let password = $("#password").val();
                        var data = {
                            "username": user_name,
                            "password": password,
                            "grant_type": "password",
                            "client_id": "4d62ce5da7760cdcf752565f47c8bce1",
                            "client_secret": "ebdfaa9dd96f7c04f218f32c4644e144d4779ba42feb6f0db57569a29fdb822c4311786d56fd053f946a58253c49a4e7f43da69752f9e9f8b440b8df686d82b4",
                            "scope": "web"
                        };
                        $.post(
                            link + "/token", 
                            data,
                            function(returnData){
                                try{
                                    localStorage.setItem("token", JSON.stringify(returnData));
                                    window.location.href = link + "/villageView";
                                }catch($e){}
                            }
                        );
                    }
                </script>
            </body>';

        echo $html;

        return new Response();
    }
}
