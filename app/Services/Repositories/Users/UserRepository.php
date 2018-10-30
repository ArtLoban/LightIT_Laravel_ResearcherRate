<?php

namespace App\Services\Repositories\Users;

use App\Models\Users\User;
use App\Services\Repositories\Repository;

class UserRepository extends Repository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return User::class;
    }
}
