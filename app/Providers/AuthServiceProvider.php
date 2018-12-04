<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Services\Users\Permission\Repository\Contracts\Repository as PermissionRepository;
use App\Services\Users\PermissionRole\Repository\Contracts\Repository as PermissionRoleRepository;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(PermissionRepository $permissionRepository, PermissionRoleRepository $permissionRoleRepository)
    {
        $this->registerPolicies();

        // The list of all available permissions
        $permissions = $permissionRepository->all();

        foreach ($permissions as $permission) {
            $this->defineRule($permission, $permissionRoleRepository);
        }
    }

    /**
     * @param $permission
     * @param PermissionRoleRepository $permissionRoleRepository
     */
    private function defineRule($permission, $permissionRoleRepository)
    {
        Gate::define($permission->name, function($user) use($permission, $permissionRoleRepository) {
            $userPermissions = $permissionRoleRepository->getAllPermissionsByRoleId($user->role->getKey());
            // Check out if User has a permission
            if ($userPermissions->contains('name', $permission->name)) {
                return true;
            }

            return false;
        });
    }
}
