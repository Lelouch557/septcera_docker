<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Application\Command\UnitTemplate;

use App\Application\Exception\EntityDoesNotExistException;
use App\Domain\Model\UnitTemplate\UnitTemplate;
use App\Infrastructure\Persistence\Doctrine\ORM\Repository\GenericRepository;
use Ramsey\Uuid\Uuid;

final class DeleteHandler {
    public function __construct(
        private GenericRepository $genericRepository
    ) {
    }

    public function __invoke(DeleteCommand $command): void {
        /** @var UnitTemplate */
        $unitTemplate = $this->genericRepository->pick(UnitTemplate::class, ["id"=>$command->getId()]);

        if($unitTemplate == null){
            throw new EntityDoesNotExistException(UnitTemplate::class);
        }

        $this->genericRepository->delete($unitTemplate);
    }
}
