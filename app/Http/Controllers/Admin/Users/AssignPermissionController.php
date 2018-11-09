<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\PermissionRole\UpdateRequest;
use App\Services\Users\Role\Repository\Contracts\Repository as RoleRepository;
use App\Services\Users\Permission\Repository\Contracts\Repository as PermissionRepository;
use App\Services\Users\PermissionRole\Repository\Contracts\Repository as PermissionRoleRepository;

class AssignPermissionController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var PermissionRoleRepository
     */
    private $permissionRoleRepository;

    /**
     * AssignPermissionController constructor.
     * @param RoleRepository $roleRepository
     * @param PermissionRepository $permissionRepository
     * @param PermissionRoleRepository $permissionRoleRepository
     */
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

    /**
     * @param UpdateRequest $request
     * @param int $roleId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, int $roleId)
    {
        $this->permissionRoleRepository->updateByRoleId($roleId, $request->permission_id);

        return redirect()->route('assign_permissions.index');
    }
}
