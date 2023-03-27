<?php



namespace App\Infrastructure\Service;

use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpFoundation\RequestStack;
use Webmozart\Assert\Assert;

#[AsController]
final class DTO
{
    public function __construct(
        private readonly RequestStack $requestStack
    ){}

}
