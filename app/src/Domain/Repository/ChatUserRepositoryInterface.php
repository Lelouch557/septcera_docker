<?php

/*
 * mine -André
 */

namespace App\Domain\Repository;

use App\Domain\Model\ChatUser\ChatUser;

interface ChatUserRepositoryInterface {
    public function getSpecific(array $parameters): array;

    public function delete(ChatUser $chatUser): void;

    public function persist(ChatUser $chatUser): void;
}
