<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Requests\Admin\Users\Role\StoreRequest;
use App\Http\Requests\Admin\Users\Role\UpdateRequest;
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $this->roleRepository->create($request->all());

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource
     *
     * @param Role $role
     * @param PermissionRoleRepository $permissionRoleRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Role $role, PermissionRoleRepository $permissionRoleRepository )
    {
        $permissions = $permissionRoleRepository->getAllPermissionsByRoleId($role->getKey());

        return view('admin.roles.show', ['role' => $role, 'permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource
     *
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Role $role)
    {
        return view('admin.roles.edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage
     *
     * @param UpdateRequest $request
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request, Role $role)
    {
        $this->roleRepository->updateById($role->getKey(), $request->input());

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage
     *
     * @param Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $this->roleRepository->delete($role);

        return back();
    }
}
