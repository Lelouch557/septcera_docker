<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input\Stockpile;

use App\Infrastructure\DTO\Input\Validator;
use App\Application\Exception\ArgumentException;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class GetSpecificDTO {
    #[Assert\Type('string')]
    private $id;

    #[Assert\Type('string')]
    private $resource_id;

    #[Assert\Type('string')]
    private $village_id;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);
        
        $this->id = (isset($data['id']))? $data['id'] : null;
        $this->resource_id = (isset($data['resource_id']))? $data['resource_id'] : null;
        $this->village_id = (isset($data['village_id']))? $data['village_id'] : null;

        if( !$this->id && !$this->resource_id && !$this->village_id ){
            throw new ArgumentException('At least one of id, resource_id or village_id must be given.');
        }

        $this->DTOInterface->validate($this);
    }

    public function getId(): ?string{
        return $this->id;
    }

    public function getResouceId(): ?string{
        return $this->resource_id;
    }

    public function getVillageId(): ?string{
        return $this->village_id;
    }
}
