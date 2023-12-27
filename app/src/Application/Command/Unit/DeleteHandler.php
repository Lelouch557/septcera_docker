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

final class DeleteHandler {
    public function __construct(
        private GenericRepository $genericRepository
    ) {
    }

    public function __invoke(DeleteCommand $command): void {
        /** @var Unit */
        $unit = $this->genericRepository->pick(Unit::class, ['id' => $command->getId()]);

        if($unit == null){
            throw new EntityDoesNotExistException(Unit::class);
        }

        $this->genericRepository->delete($unit);
    }
}
