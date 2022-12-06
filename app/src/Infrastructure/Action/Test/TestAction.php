<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Test;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class TestAction {
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): Response {
        return new Response('joke', 418);
    }

    public function nope(Request $request): Response {
        return new Response('joke', 418);
    }
}
