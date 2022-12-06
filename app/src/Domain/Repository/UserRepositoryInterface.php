<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\User\User;

interface UserRepositoryInterface {
    public function getSpecific(array $parameters): array;

    public function delete(User $user): void;

    public function persist(User $user): void;
}
