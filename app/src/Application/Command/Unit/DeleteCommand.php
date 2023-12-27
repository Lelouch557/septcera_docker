<?php

declare(strict_types=1);
/*
* mine -Andre
*/

namespace App\Application\Command\Unit;

use Ramsey\Uuid\UuidInterface;

final class DeleteCommand {
    public function __construct(
        private readonly UuidInterface $id
    ) {
    }

    public function getId(): UuidInterface {
        return $this->id;
    }
}
