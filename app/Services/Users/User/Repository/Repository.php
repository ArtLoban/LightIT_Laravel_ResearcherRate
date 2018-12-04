<?php

namespace App\Services\Users\User\Repository;

use App\Models\Users\User;
use App\Services\Users\User\Repository\Contracts\Repository as UserRepository;
use App\Services\Utilities\Repository\RepositoryAbstract;

class Repository extends RepositoryAbstract implements UserRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return User::class;
    }

    /**
     * @param int $id
     * @return User
     */
    public function getWithNestedRelationsById(int $id): User
    {
        return $this->className::with([
                'role',
                'profile.position',
                'profile.academicDegree',
                'profile.academicTitle',
                'profile.department'
            ])->whereId($id)->firstOrFail();
    }
}
