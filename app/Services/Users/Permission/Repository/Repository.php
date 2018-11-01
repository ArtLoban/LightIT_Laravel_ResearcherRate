<?php

namespace App\Services\Users\Permission\Repository;

use App\Models\Users\Permission;
use App\Services\Users\Permission\Repository\Contracts\Repository as PermissionRepository;
use App\Services\Utilities\Repository\RepositoryAbstract;

class Repository extends RepositoryAbstract implements PermissionRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Permission::class;
    }
}
