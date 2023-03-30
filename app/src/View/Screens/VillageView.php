<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\View\Account;

use App\Infrastructure\Service\CurrentAdminService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;

class LoginView {
    use HandleTrait;
    public function __construct(
        private CurrentAdminService $adminService
        ) {
    }
    public function __invoke(): Response {
        $user = $this->adminService->getCurrentUser();
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
                </style>

                <div class="login">
                    <form>
                        <input class="login-input" type="text" id="user_name" placeholder="username"/>
                        <input class="login-input" type="password" id="password" placeholder="password"/>
                        <input class="button" type="button" value="Login" onclick="login()"/>
                    </form>
                </div>
            </body>';

        echo $html;
        return new Response();
    }
}

