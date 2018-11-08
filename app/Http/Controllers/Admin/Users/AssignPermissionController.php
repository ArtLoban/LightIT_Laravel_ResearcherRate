<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Services\Users\Permission\Repository\Contracts\Repository as PermissionRepository;
use App\Services\Users\PermissionRole\Repository\Contracts\Repository as PermissionRoleRepository;
use App\Services\Users\Role\Repository\Contracts\Repository as RoleRepository;

class AssignPermissionController extends Controller
{
    private $roleRepository;
    private $permissionRepository;
    private $permissionRoleRepository;

    public function __construct(
        RoleRepository $roleRepository,
        PermissionRepository $permissionRepository,
        PermissionRoleRepository $permissionRoleRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
        $this->permissionRoleRepository = $permissionRoleRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->roleRepository->allWithRelations(['permissionRoles.permission']);

        return view('admin.assign_permissions.index', ['roles' => $roles]);
    }

    /**
     * @param int $roleId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $roleId)
    {
        return view('admin.assign_permissions.edit', [
            'role' => $this->roleRepository->whereId($roleId),
            'permissions' => $this->permissionRepository->all(),
            'assignedPermissions' => $this->permissionRoleRepository->getAllPermissionIdsByRoleId($roleId)
        ]);
    }

    public function update(UpdateRequest $request, $roleId)
    {
//        $this->permissionRepository->updateById($permissionId, $request->input());

        return redirect()->route('assign_permissions.index');
    }
}
