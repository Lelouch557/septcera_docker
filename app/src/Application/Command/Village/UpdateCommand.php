<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Command\Village;

use App\Domain\Model\User\User;
use Ramsey\Uuid\UuidInterface;

final class UpdateCommand {
    public function __construct(
        private readonly UuidInterface $id,
        private readonly string $name,
        private readonly string $type,
    ) {
    }
    public function get($parameter){
        return $this->$parameter;
    }

    public function getId(): UuidInterface {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }
}
