<?php

namespace App\Infrastructure\Persistence\DTO\Output;

use App\Domain\Model\ChatBericht\ChatBericht;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ChatBerichtDTO implements \JsonSerializable{
    public function __construct(
        private ChatBericht $chatBericht
    ){
        $this-> chatBericht = $chatBericht;
    }

    public function JsonSerialize(): mixed{
        return [
            "user" => $this->chatBericht->getUser()->getId(),
            "text" => $this->chatBericht->getText(),
            "created_at" => $this->chatBericht->getCreatedAt(),
            "updated" => ($this->chatBericht->getCreatedAt() != $this->chatBericht->getUpdatedAt())
        ];
    }
}


