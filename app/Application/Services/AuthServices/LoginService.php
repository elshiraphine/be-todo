<?php

namespace App\Application\Services\AuthServices;

use App\Infrastructure\Repository\UserRepository;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginService
{
    /**
     * @param array $credentials
     * @return array|bool
     */
    public function login(array $credentials): array|bool
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);

            return [
                'token' => $token,
                'user' => $user
            ];
        }
        return false;
    }
}
