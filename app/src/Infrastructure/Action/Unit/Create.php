<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Infrastructure\Action\Unit;

use App\Application\Command\GenericCreateCommand;
use App\Application\Exception\EntityAlreadyExistsException;
use App\Infrastructure\DTO\Input\Unit\CreateDTO;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Domain\Exception\ExceptionCodes;
use App\Domain\Model\Unit\Unit;
use App\Domain\Model\UnitTemplate\UnitTemplate;
use \DateTime;

class Create {
    use HandleTrait;

    public function __construct(
        MessageBusInterface $messageBus,
        private CreateDTO $createDTO
    ) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(): JsonResponse {
        /** @var string  */
        $id = $this->createDTO->getId();
        $id = ($id == null)? Uuid::uuid4() : Uuid::fromString($id);

        $this->handle(new GenericCreateCommand(
            'ADD',
            Unit::class,
            [
                'id' => $id,
                'UnitTemplate' => Uuid::fromString($this->createDTO->getUnitTemplate()),
                'Village' => Uuid::fromString($this->createDTO->getVillage()),
                'amount' => $this->createDTO->getAmount(),
                'createdAt' => new DateTime(),
                'updatedAt' => new DateTime()
            ],
            [
                'unitTemplate' => Uuid::fromString($this->createDTO->getUnitTemplate()),
                'village' => Uuid::fromString($this->createDTO->getVillage())
            ],
            [
                'amount'
            ]
        ));

        return new JsonResponse(['id' => $id], Response::HTTP_OK);
    }
}
