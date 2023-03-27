<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\ChatBericht\ChatBericht;

interface ChatBerichtRepositoryInterface {
    public function getSpecific(array $parameters): array;

    public function delete(ChatBericht $chatUser): void;

    public function persist(ChatBericht $chatUser): void;
}
