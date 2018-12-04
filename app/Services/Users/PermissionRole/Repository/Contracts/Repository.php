<?php

namespace App\Services\Users\PermissionRole\Repository\Contracts;

use Illuminate\Support\Collection;

interface Repository
{
    /**
     * @param int $roleId
     * @return Collection|null
     */
    public function getAllPermissionsByRoleId(int $roleId): ?Collection;

    /**
     * @param int $roleId
     * @return Collection|null
     */
    public function getAllPermissionIdsByRoleId(int $roleId): ?Collection;

    /**
     * @param int $roleId
     * @param array|null $permissions
     * @return mixed
     */
    public function updateByRoleId(int $roleId, ?array $permissions = []);
}
