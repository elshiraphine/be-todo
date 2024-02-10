<?php

namespace App\Application\Services\AuthServices;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutService
{
   /**
        * @param string $token
        * @return bool
        * @throws \Exception
        */
    public function logout($token)
    {
        try {
            if (!$token) {
                throw new \Exception('Token is missing');
            }

            JWTAuth::parseToken($token)->invalidate();

            return true;
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
