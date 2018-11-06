<?php

namespace App\Services\Users\PermissionRole\Repository;

use App\Models\Users\PermissionRole;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Users\PermissionRole\Repository\Contracts\Repository as PermissionRoleRepository;
use Illuminate\Support\Collection;

class Repository extends RepositoryAbstract implements PermissionRoleRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return PermissionRole::class;
    }

    /**
     * @param int $roleId
     * @return Collection|null
     */
    public function getAllPermissionsByRoleId(int $roleId): ?Collection
    {
        return  $this->className::where('role_id', $roleId)->with('permission')->get()->pluck('permission');
    }
}
