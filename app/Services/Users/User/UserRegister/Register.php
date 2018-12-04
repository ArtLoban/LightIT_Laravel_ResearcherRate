<?php

namespace App\Services\Users\User\UserRegister;

use App\Models\Users\User;
use App\Models\Users\BlankUser;
use App\Helpers\Hasher\Contracts\HasherInterface;
use App\Services\Users\User\UserRegister\Contracts\UserRegister;
use App\Services\Users\User\Repository\Contracts\Repository as UserRepository;
use App\Services\Users\BlankUser\Repository\Contracts\Repository as BlankUserRepository;

class Register implements UserRegister
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @var HasherInterface
     */
    private $hasher;

    /**
     * @var BlankUserRepository
     */
    private $blankUserRepository;

    /**
     * Register constructor.
     * @param UserRepository $userRepository
     * @param HasherInterface $hasher
     * @param BlankUserRepository $blankUserRepository
     */
    public function __construct(
        UserRepository $userRepository,
        HasherInterface $hasher,
        BlankUserRepository $blankUserRepository
    ) {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
        $this->blankUserRepository = $blankUserRepository;
    }

    /**
     * @param array $data
     * @return User
     * @throws \Exception
     */
    public function registrate(array $data): User
    {
        // Create a new user
        $newUser = $this->createNewUser($data);
        // Find a record with a certain temporary personal key value
        $blankUser = $this->getBlankUser($data['personal_key']);
        // Get associated with a BlankUser Profile model
        $userProfile = $blankUser->profile;
        // Assign newly created User to a certain Profile
        $userProfile->user_id = $newUser->getKey();
        $userProfile->save();
        // Remove needed no more the BlankUser record
        $blankUser->delete();

        return $newUser;
    }

    /**
     * @param array $data
     * @return User
     */
    private function createNewUser(array $data): User
    {
        $user = $this->userRepository->create([
            'email' => $data['email'],
            'password' => $this->hasher->make($data['password']),
        ]);

        return $user;
    }

    /**
     * @param int $personalKey
     * @return BlankUser
     */
    private function getBlankUser(int $personalKey): BlankUser
    {
        return $this->blankUserRepository->where('personal_key', $personalKey)->first();
    }
}
