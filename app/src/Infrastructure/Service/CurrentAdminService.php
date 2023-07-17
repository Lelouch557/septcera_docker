<?php

/*
 * mine -André
 */

namespace App\Infrastructure\Service;

use App\Domain\Model\User\User;
use App\Domain\Repository\UserRepositoryInterface;
use Error;
use Exception;
use Symfony\Component\HttpFoundation\RequestStack;
use Webmozart\Assert\Assert;

final class CurrentAdminService {
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly UserRepositoryInterface $userRepository,
    ) {
    }

    public function getCurrentUser($token = null): ?User {
        if(!$token){
            $request = $this->requestStack->getCurrentRequest();
            if (empty($request)) {
                return null;
            }

            $authHeader = $request->headers->get('Authorization');

            if (empty($authHeader)) {
                return null;
            }
            $jwt = str_replace('Bearer ', '', $authHeader);
        }else{
            $jwt = $token;
        }
        
        $explosion = explode('.', $jwt);
        Assert::count($explosion, 3);
        $jwtJson = base64_decode($explosion[1]);

        $jwtData = json_decode($jwtJson, true);
        Assert::keyExists($jwtData, 'aud');
        Assert::notEmpty($jwtData['aud']);
        $user = $this->userRepository->getSpecific(['name' => $jwtData['sub']]);
        // print_r($user);
        // die;
        if ($user) {
            return $user[0];
        }

        return null;
    }
}
