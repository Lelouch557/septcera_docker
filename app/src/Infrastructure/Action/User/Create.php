<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\Action\User;

use App\Application\Command\User\CreateCommand;
use App\Application\Command\Village\CreateCommand as VillageCreateCommand;
use App\Application\Exception\EntityAlreadyExistsException;
use App\Domain\Model\User\User;
use App\Infrastructure\DTO\Input\User\CreateDTO;
use App\Infrastructure\Service\CurrentAdminService;
use App\Infrastructure\Validator\Validator;
use DateTime;
use Exception;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

class Create {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private CurrentAdminService $currentAdmin,
        private CreateDTO $createDTO
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): JsonResponse {
        $id = Uuid::uuid4();

        $result = substr(hash('sha256', random_bytes(50)), 50);
    	try{
            
            $this->handle(new CreateCommand(
                $id,
                $this->createDTO->getName(),
                $this->createDTO->getPassword(),
                $this->createDTO->getEmail(),
                $result,
                'Active',
                ['ROLE_USER']
            ));

        }catch(EntityAlreadyExistsException | HandlerFailedException $e){
            return new JsonResponse(["Response" => explode(":", $e->getMessage())], 409);
        }

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}
