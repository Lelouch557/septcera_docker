<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\Chat\Chat;

interface ChatRepositoryInterface {
    public function getSpecific(array $parameters): array;

    public function delete(Chat $user): void;

    public function persist(Chat $chat): void;
}
