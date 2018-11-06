<?php

namespace App\Http\Controllers\Admin\Users;

use App\Models\Users\Role;
use App\Http\Controllers\Controller;
use App\Services\Users\Role\Repository\Contracts\Repository as RoleRepository;
use App\Services\Users\PermissionRole\Repository\Contracts\Repository as PermissionRoleRepository;

class RoleController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * UserController constructor.
     * @param RoleRepository $role
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.roles.index', [
            'roles' => $this->roleRepository->all(),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role, PermissionRoleRepository $permissionRoleRepository )
    {
        $permissions = $permissionRoleRepository->getAllPermissionsByRoleId($role->getKey());

        return view('admin.roles.show', ['role' => $role, 'permissions' => $permissions]);
    }
}
