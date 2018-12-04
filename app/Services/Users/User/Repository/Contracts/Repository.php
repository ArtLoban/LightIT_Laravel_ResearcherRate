<?php

namespace App\Services\Users\User\Repository\Contracts;

use App\Models\Users\User;
use App\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param int $userId
     * @return User
     */
    public function getWithNestedRelationsById(int $userId): User;
}
