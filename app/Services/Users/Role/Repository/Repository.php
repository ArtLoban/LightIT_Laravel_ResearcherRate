<?php

namespace App\Services\Users\Role\Repository;

use App\Models\Users\Role;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Users\Role\Repository\Contracts\Repository as RoleRepository;

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
