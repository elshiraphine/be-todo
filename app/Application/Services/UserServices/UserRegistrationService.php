<?php

namespace App\Application\Services\UserServices;

use App\Core\Entity\User;
use App\Infrastructure\Repository\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserRegistrationService
{
    /**
     * @var UserRepository $userRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param array $data
     * @return User
     */
    public function register(array $data): User
    {
        $data['password'] = Hash::make($data['password']);
        return $this->userRepository->create($data);
    }
}
