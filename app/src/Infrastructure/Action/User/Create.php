<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\User;

use App\Application\Command\User\CreateCommand;
use App\Infrastructure\Validator\Validator;
use Ramsey\Uuid\Uuid;
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
    }

    public function __invoke(Request $request): JsonResponse {
        $this->validator->setRequest($request);
        $this->validator->name('string', false, false, null);
        
        $id = Uuid::uuid4();
        $this->handle(new CreateCommand(
            $this->validator->id(),
            $this->validator->name('string', false, false, null),
            $this->validator->password('string', false, false, null),
            $this->validator->email('email', false, false, null),
            random_bytes(50),
            $this->validator->status('string', false, false, null),
            $this->validator->roles('array', false, false, null)
        ));
        print_r($id);
        exit();
        return new JsonResponse($id, Response::HTTP_OK);
    }
}
