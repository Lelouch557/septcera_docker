<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\Chat;

use App\Application\Command\Chat\CreateCommand;
use App\Infrastructure\Validator\Validator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Create {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private Validator $validator
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): JsonResponse {
        $this->validator->setRequest($request);

        $id = $this->validator->id();
        $this->handle(new CreateCommand(
            $id,
            $this->validator->users(type: 'array', nullable: false, empty: false)
        ));

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}
