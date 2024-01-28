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

class Test2 extends AbstractController{
    use HandleTrait;
    
    public function __construct(
        private HttpClientInterface $client,
        private CurrentAdminService $adminService
    ) {
    }
    
    public function __invoke(RequestStack $requestStack): Response {
        return $this->render('Test2.html.twig');
    }
}
