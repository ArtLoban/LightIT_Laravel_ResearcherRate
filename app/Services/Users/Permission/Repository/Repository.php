<?php

namespace App\Services\Users\Permission\Repository;

use App\Models\Users\Permission;
use App\Services\Users\Permission\Repository\Contracts\Repository as PermissionRepository;
use App\Utilities\Repository\RepositoryAbstract;

class Repository extends \App\Utilities\Repository\RepositoryAbstract implements PermissionRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Permission::class;
    }
}
