<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\ChatBericht;

use App\Application\Command\ChatBericht\CreateCommand;
use App\Application\Query\ChatBericht\SpecificQuery;
use App\Domain\Model\Chat\Chat;
use App\Domain\Model\User\User;
use App\Infrastructure\Persistence\DTO\Output\ChatBerichtDTO;
use App\Infrastructure\Validator\Validator;
use PhpParser\Node\Expr\Instanceof_;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class GetByUser {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $queryBus,
        private Validator $validator,
        private RequestStack $requestStack
    ) {
        $this->messageBus = $queryBus;
    }

    public function __invoke(
        Request $request,
        string $user_id
    ): JsonResponse {
        $this->validator->setRequest($request);
        
        $data = $this->handle(new SpecificQuery(
            userId: $this->validator->object(
                id: $user_id, 
                class: User::class
            ),
        ));
        $returnData = [];

        foreach( $data as $item){
            $returnData[] = new ChatBerichtDTO($item);
        }

        return new JsonResponse($returnData);
    }
}
