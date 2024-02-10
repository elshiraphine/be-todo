<?php

namespace App\Http\Controllers;

use App\Application\Services\UserServices\UserRegistrationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    /**
     * @var UserRegistrationService $userRegistrationService
     */
    protected UserRegistrationService $userRegistrationService;

    /**
     * @param UserRegistrationService $userRegistrationService
     */
    public function __construct(UserRegistrationService $userRegistrationService)
    {
        $this->userRegistrationService = $userRegistrationService;
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Register the user
        $user = $this->userRegistrationService->register($request->only('name', 'email', 'password'));

        return apiResponse(200, 'success', $user);
    }
}
