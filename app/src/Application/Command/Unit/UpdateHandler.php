<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Application\Command\Unit;

use App\Domain\Model\Unit\Unit;
use App\Infrastructure\Persistence\Doctrine\ORM\Repository\GenericRepository;
use App\Application\Exception\EntityDoesNotExistException;
use Ramsey\Uuid\Uuid;

final class UpdateHandler {
    public function __construct(
        private GenericRepository $genericRepository
    ) {
    }

    public function __invoke(UpdateCommand $command): void {
        /** @var Unit */
        $unit = $this->genericRepository->pick(Unit::class, ['id' => $command->getId()]);

        if($unit == null){
            throw new EntityDoesNotExistException(Unit::class);
        }

        $unit->setId($command->getId());
        $unit->setAmount($command->getAmount());
        $unit->setUpdatedAt(new \DateTime());

        $this->genericRepository->set($unit);
    }
}
