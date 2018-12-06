<?php

namespace App\Services\Users\PermissionRole\Repository;

use App\Models\Users\PermissionRole;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Users\PermissionRole\Repository\Contracts\Repository as PermissionRoleRepository;
use Illuminate\Support\Collection;

class Repository extends \App\Utilities\Repository\RepositoryAbstract implements PermissionRoleRepository
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

    /**
     * @param int $roleId
     * @return Collection|null
     */
    public function getAllPermissionIdsByRoleId(int $roleId): ?Collection
    {
        return  $this->className::where('role_id', $roleId)->pluck('permission_id');
    }

    /**
     * @param int $roleId
     * @param array|null $permissions
     */
    public function updateByRoleId(int $roleId, ?array $permissions = [])
    {
        $assignedPermissions = $this->getAllPermissionIdsByRoleId($roleId);
        $permissionsToRemove = $assignedPermissions->diff($permissions);
        $permissionsToAdd = collect($permissions)->diff($assignedPermissions);

        if ($permissionsToAdd->isNotEmpty()) {
            $data = $this->transformData($roleId, $permissionsToAdd->all());

            $this->className::insert($data);
        }

        if ($permissionsToRemove->isNotEmpty()) {
            $this->deleteByIdValues($roleId, $permissionsToRemove->all());
        }
    }

    /**
     * @param $roleId
     * @param $permissionIds
     * @return array
     */
    private function transformData($roleId, $permissionIds): array
    {
        $data = [];
        foreach ($permissionIds as $permissionId) {
            $data[] = ['role_id' => $roleId, 'permission_id' => $permissionId];
        }

        return $data;
    }

    /**
     * @param int $roleId
     * @param array $permissionIds
     * @return mixed
     */
    private function deleteByIdValues(int $roleId, array $permissionIds)
    {
        return $this->className::where('role_id', $roleId)->whereIn('permission_id', $permissionIds)->delete();
    }
}
