<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query\ChatBericht;

use App\Domain\Model\User\User;

class SpecificQuery {
    public function __construct(
        private ?User $userId = null
    ) {
    }

    public function getUser(): User {
        return $this->userId;
    }
}
