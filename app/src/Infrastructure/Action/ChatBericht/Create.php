<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\ChatBericht;

use App\Application\Command\ChatBericht\CreateCommand;
use App\Domain\Model\Chat\Chat;
use App\Domain\Model\User\User;
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
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): JsonResponse {
        $this->validator->setRequest($request);
        $id = $this->validator->id();
        
        $this->handle(new CreateCommand(
            $id,
            $this->validator->id(
                id: $this->validator->user_id(type: 'string', nullable: false, empty: false), 
                class: User::class
            ),
            $this->validator->id(
                id: $this->validator->chat_id(type: 'string', nullable: false, empty: false), 
                class: Chat::class
            ),
            $this->validator->text(type: 'string'), 
        ));
    
        return new JsonResponse(['id'=>$id], Response::HTTP_OK);
    }
}
