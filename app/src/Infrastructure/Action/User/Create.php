<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\User;

use App\Application\Command\User\CreateCommand;
use App\Infrastructure\Service\CurrentAdminService;
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
        private CurrentAdminService $currentAdmin,
        private Validator $validator
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): JsonResponse {
        $this->validator->setRequest($request);
        
        $result = substr(hash("sha256",random_bytes(50)), 50);

        $id = $this->validator->id();
        $this->handle(new CreateCommand(
            $id,
            $this->validator->name(type: 'string', nullable: false, empty: false),
            $this->validator->password(type: 'string', nullable: false, empty: false),
            $result,
            $this->validator->email(type: 'string', nullable: false, empty: false),
            'Active',
            $this->validator->roles(type: 'array', nullable: false, empty: false, choice: [['ROLE_USER'], ['ROLE_ADMIN']])
        ));
        return new JsonResponse(['id'=>$id], Response::HTTP_OK);
    }
}
