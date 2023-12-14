<?php
/*
 * mine -André
 */
namespace App\Domain\Model\BuildingTemplate;
use App\Domain\Model\Resource\Resource;
use Ramsey\Uuid\UuidInterface;
class BuildingTemplate {
    public function __construct(
        private UuidInterface $id,
        private string $name,
        private string $effect,
        private Resource $resource,
        private \DateTime $createdAt,
        private \DateTime $updatedAt
    ) {
    }
    public function getId(): UuidInterface {
        return $this->id;
    }
    public function getName(): string {
        return $this->name;
    }
    public function getEffect(): string {
        return $this->effect;
    }
    public function getResource(): Resource {
        return $this->resource;
    }
    public function getCreatedAt(): \DateTime {
        return $this->createdAt;
    }
    public function getUpdatedAt(): \DateTime {
        return $this->updatedAt;
    }

    public function setId(UuidInterface $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setEffect(string $effect): void {
        $this->effect = $effect;
    }

    public function setResource(Resource $resource): void {
        $this->resource = $resource;
    }

    public function setCreatedAt(\DateTime $createdAt): void {
        $this->createdAt = $createdAt;
    }

    public function setUpdatedAt(\DateTime $updatedAt): void {
        $this->updatedAt = $updatedAt;
    }
}
