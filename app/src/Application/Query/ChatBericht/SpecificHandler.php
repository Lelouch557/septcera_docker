<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Application\Query\ChatBericht;

use App\Domain\Repository\ChatBerichtRepositoryInterface;

class SpecificHandler {
    public function __construct(
        private ChatBerichtRepositoryInterface $chatBerichtRepository
    ) {
    }

    public function __invoke(SpecificQuery $query) {
        $parameters = [];
        if ($query->getUser()) {
            $parameters['user'] = $query->getUser();
        }

        return $this->chatBerichtRepository->getSpecific($parameters);
    }
}
