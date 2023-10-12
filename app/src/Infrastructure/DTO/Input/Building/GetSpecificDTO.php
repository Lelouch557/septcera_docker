<?php

declare(strict_types=1);

/*
 * mine -André
 */

namespace App\Infrastructure\DTO\Input\Building;

use App\Infrastructure\DTO\Input\Validator;
use App\Application\Exception\ArgumentException;
use Exception;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints as Assert;

final class GetSpecificDTO {
    #[Assert\Type('string')]
    private $building_id;

    #[Assert\Type('string')]
    private $template_id;

    #[Assert\Type('string')]
    private $village_id;

    public function __construct(
        private readonly RequestStack $requestStack,
        private Validator $DTOInterface
    ) {
        $content = $this->requestStack->getCurrentRequest()->getContent();
        $data = json_decode($content, true);
        
        $this->building_id = (isset($data['building_id']))? $data['building_id'] : null;
        $this->template_id = (isset($data['template_id']))? $data['template_id'] : null;
        $this->village_id = (isset($data['village_id']))? $data['village_id'] : null;

        // print_r(!$this->building_id);
        // print_r(' - ');
        // print_r(!$this->template_id);
        // print_r(' - ');
        // print_r(!$this->village_id);

        if( !$this->building_id && !$this->template_id && !$this->village_id ){
            throw new ArgumentException('At least one id of building, template or village must be given.');
        }

        $this->DTOInterface->validate($this);
    }

    public function getBuildingId(): ?string{
        return $this->building_id;
    }

    public function getTemplateId(): ?string{
        return $this->template_id;
    }

    public function getVillageId(): ?string{
        return $this->village_id;
    }
}
