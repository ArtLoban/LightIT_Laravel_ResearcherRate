<?php

namespace App\Services\Users\User\UserRegister\Contracts;

use App\Models\Users\User;

interface UserRegister
{
    /**
     * @param array $data
     * @return User
     */
    public function registrate(array $data): User;
}
