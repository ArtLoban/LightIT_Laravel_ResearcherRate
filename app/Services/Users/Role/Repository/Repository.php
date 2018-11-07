<?php

namespace App\Services\Users\Role\Repository;

use App\Models\Users\Role;
use App\Services\Users\Role\Repository\Contracts\Repository as RoleRepository;
use App\Services\Utilities\Repository\RepositoryAbstract;

class Repository extends RepositoryAbstract implements RoleRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Role::class;
    }
}
