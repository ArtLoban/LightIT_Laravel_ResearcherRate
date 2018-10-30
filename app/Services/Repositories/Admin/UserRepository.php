<?php

namespace App\Services\Repositories\Admin;

use App\Models\Admin\User;
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
