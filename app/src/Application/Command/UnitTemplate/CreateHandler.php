<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Application\Command\UnitTemplate;

use App\Application\Exception\EntityAlreadyExistsException;
use App\Domain\Model\UnitTemplate\UnitTemplate;
use App\Infrastructure\Persistence\Doctrine\ORM\Repository\GenericRepository;
use Ramsey\Uuid\Uuid;

final class CreateHandler {
    public function __construct(
        private GenericRepository $genericRepository
    ) {
    }

    public function __invoke(CreateCommand $command): void {
        $unitTemplate = $this->genericRepository->pick(UnitTemplate::class, ['name' => $command->getName()]);
        
        if($unitTemplate != null){
            throw new EntityAlreadyExistsException(UnitTemplate::class, '');
        }

        $unitTemplate = new UnitTemplate(
            $command->getId(),
            $command->getName(),
            $command->getOffence(),
            $command->getDefense(),
            $command->getHp(),
            new \DateTime(),
            new \DateTime()
        );
        $this->genericRepository->set($unitTemplate);
    }
}
