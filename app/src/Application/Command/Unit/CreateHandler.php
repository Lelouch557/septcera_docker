<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Application\Command\Unit;

use App\Domain\Model\Unit\Unit;
use App\Infrastructure\Persistence\Doctrine\ORM\Repository\GenericRepository;
use App\Application\Exception\EntityAlreadyExistsException;
use App\Application\Exception\EntityDoesNotExistException;
use App\Domain\Model\UnitTemplate\UnitTemplate;
use App\Domain\Model\Village\Village;
use Ramsey\Uuid\Uuid;

final class CreateHandler {
    public function __construct(
        private GenericRepository $genericRepository
    ) {
    }

    public function __invoke(CreateCommand $command): void {
        $unit = $this->genericRepository->pick(Unit::class, ['unitTemplate' => $command->getUnitTemplate()]);

        if($unit != null){
            throw new EntityAlreadyExistsException(Unit::class, '');
        }
        /** @var UnitTemplate */
        $unitTemplate = $this->genericRepository->pick(UnitTemplate::class, ['unitTemplate' => $command->getUnitTemplate()]);

        if($unitTemplate == null){
            throw new EntityDoesNotExistException(Unit::class);
        }
        /** @var Village */
        $village = $this->genericRepository->pick(Village::class, ['village' => $command->getVillage()]);

        if($village == null){
            throw new EntityDoesNotExistException(Unit::class);
        }
        $unit = new Unit(
            $command->getId(),
            $unitTemplate,
            $village,
            $command->getAmount(),
            new \DateTime(),
            new \DateTime()
        );
        $this->genericRepository->set($unit);
    }
}
