<?php

namespace App\Services\Users\User\Repository\Contracts;

use App\Models\Users\User;

interface Repository
{
    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * @param int $userId
     * @return User
     */
    public function getWithNestedRelationsById(int $userId): User;
}
