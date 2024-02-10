<?php

namespace App\Http\Controllers;


use App\Application\Services\AuthServices\LoginService;
use App\Application\Services\AuthServices\LogoutService;
use \Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    private LoginService $loginService;
    private LogoutService $logoutService;

    public function __construct(LoginService $loginService, LogoutService $logoutService)
    {
        $this->loginService = $loginService;
        $this->logoutService = $logoutService;
    }


    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $result = $this->loginService->login($credentials);

        if ($result) {
            return apiResponse(200, 'success', $result);
        } else {
            return apiResponse(401, 'error', ['message' => 'Unauthorized']);
        }
    }

    public function logout(Request $request): JsonResponse
    {

        try {
            $token = $request->bearerToken();
            $this->logoutService->logout($token);

            return apiResponse(200, 'success', ['message' => 'Successfully logged out']);
        } catch (\Exception $e) {
            return apiResponse(400, 'error', ['message' => $e->getMessage()]);
        }
    }
}
