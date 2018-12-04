<?php

namespace App\Providers;

use App\Services\Users\Permission\Repository\Repository as PermissionRepository;
use App\Services\Users\Role\Repository\Repository as RoleRepository;
use App\Services\Users\User\Repository\Repository as UserRepository;
use App\Services\Organization\Facility\Faculty\Repository\Repository as FacultyRepository;
use App\Services\Organization\Facility\Department\Repository\Repository as DepartmentRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(\App\Services\Users\Permission\Repository\Contracts\Repository::class, PermissionRepository::class);
        $this->app->bind(\App\Services\Users\Role\Repository\Contracts\Repository::class, RoleRepository::class);
        $this->app->bind(\App\Services\Users\User\Repository\Contracts\Repository::class, UserRepository::class);
        $this->app->bind(\App\Services\Organization\Facility\Faculty\Repository\Contracts\Repository::class, FacultyRepository::class);
        $this->app->bind(\App\Services\Organization\Facility\Department\Repository\Contracts\Repository::class, DepartmentRepository::class);
    }
}
