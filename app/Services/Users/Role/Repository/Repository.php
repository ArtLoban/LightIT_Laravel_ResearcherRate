<?php

namespace App\Services\Users\Role\Repository;

use App\Models\Users\Role;
use App\Services\Users\Role\Repository\Contracts\Repository as RoleRepository;
use App\Services\Utilities\Repository\RepositoryAbstract;
use Illuminate\Support\Collection;

class Repository extends RepositoryAbstract implements RoleRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Role::class;
    }

    /**
     * @param int $id
     * @return Collection|null
     */
    public function getAllPermissionsByRoleId(int $id): ?Collection
    {
        return $this->className::find($id)->permissionRoles()->with('permission')->get()->pluck('permission');
    }
}
