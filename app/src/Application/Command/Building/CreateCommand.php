<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Building;
use App\Domain\Model\User\User;
use Ramsey\Uuid\UuidInterface;

final class CreateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly string $building,
        private readonly UuidInterface $villageId
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getBuildingname(): string {
        return $this->building;
    }

    public function getVillageId(): UuidInterface {
        return $this->villageId;
    }
}
