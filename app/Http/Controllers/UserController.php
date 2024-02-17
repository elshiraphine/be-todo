<?php

namespace App\Http\Controllers;

use App\Application\Services\UserServices\UserRegistrationService;
use App\Core\Entity\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8',
            ]);
        } catch (ValidationException $e) {
            if ($e->errors()['email'][0] === 'The email has already been taken.') {
                return apiResponse(409, 'error', ['message' => 'email_already_exists']);
            } else {
                return apiResponse(403, 'error', [
                    'message' => 'invalid_input',
                    'error' => $e->validator->errors()->first()
                ]);
            }
        }

        $user = $this->userRegistrationService->register($request->only('name', 'email', 'password'));

        return apiResponse(200, 'success', ['message' => 'user_registered_successfully', 'user' => $user]);
    }

}
