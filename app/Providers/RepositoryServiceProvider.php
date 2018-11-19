<?php

namespace App\Providers;

use App\Services\Publications\Article\Repository\Repository as ArticleRepository;
use App\Services\Publications\Author\Repository\Repository as AuthorRepository;
use App\Services\Publications\Journal\Repository\Repository as JournalRepository;
use App\Services\Publications\PublicationType\Repository\Repository as PublicationTypeRepository;
use App\Services\Users\Permission\Repository\Repository as PermissionRepository;
use App\Services\Users\PermissionRole\Repository\Repository as PermissionRoleRepository;
use App\Services\Users\Role\Repository\Repository as RoleRepository;
use App\Services\Users\User\Repository\Repository as UserRepository;
use App\Services\Users\BlankUser\Repository\Repository as BlankUserRepository;
use App\Services\Organization\Facility\Faculty\Repository\Repository as FacultyRepository;
use App\Services\Organization\Facility\Department\Repository\Repository as DepartmentRepository;
use App\Services\Organization\Employees\AcademicDegree\Repository\Repository as AcademicDegreeRepository;
use App\Services\Organization\Employees\AcademicTitle\Repository\Repository as AcademicTitleRepository;
use App\Services\Organization\Employees\Position\Repository\Repository as PositionRepository;
use App\Services\Organization\Employees\Profile\Repository\Repository as ProfileRepository;

use App\Services\Utilities\Files\Repository\Repository;
use App\Services\Utilities\LanguageRepository\ConfigLanguageRepository;

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
        // Users
        $this->app->bind(\App\Services\Users\Permission\Repository\Contracts\Repository::class, PermissionRepository::class);
        $this->app->bind(\App\Services\Users\Role\Repository\Contracts\Repository::class, RoleRepository::class);
        $this->app->bind(\App\Services\Users\User\Repository\Contracts\Repository::class, UserRepository::class);
        $this->app->bind(\App\Services\Users\BlankUser\Repository\Contracts\Repository::class, BlankUserRepository::class);
        $this->app->bind(\App\Services\Users\PermissionRole\Repository\Contracts\Repository::class, PermissionRoleRepository::class);
        // Organization/Facility
        $this->app->bind(
            \App\Services\Organization\Facility\Faculty\Repository\Contracts\Repository::class,
            FacultyRepository::class
        );
        $this->app->bind(
            \App\Services\Organization\Facility\Department\Repository\Contracts\Repository::class,
            DepartmentRepository::class
        );
        // Organization/Employees
        $this->app->bind(
            \App\Services\Organization\Employees\AcademicDegree\Repository\Contracts\Repository::class,
            AcademicDegreeRepository::class
        );
        $this->app->bind(
            \App\Services\Organization\Employees\AcademicTitle\Repository\Contracts\Repository::class,
            AcademicTitleRepository::class
        );
        $this->app->bind(
            \App\Services\Organization\Employees\Position\Repository\Contracts\Repository::class,
            PositionRepository::class
        );
        $this->app->bind(
            \App\Services\Organization\Employees\Profile\Repository\Contracts\Repository::class,
            ProfileRepository::class
        );
        // Publications
        $this->app->bind(
            \App\Services\Publications\PublicationType\Repository\Contracts\Repository::class,
            PublicationTypeRepository::class
        );
        $this->app->bind(
            \App\Services\Publications\Article\Repository\Contracts\Repository::class,
            ArticleRepository::class
        );
        $this->app->bind(
            \App\Services\Publications\Journal\Repository\Contracts\Repository::class,
            JournalRepository::class
        );
        $this->app->bind(
            \App\Services\Publications\Author\Repository\Contracts\Repository::class,
            AuthorRepository::class
        );

        $this->app->bind(
            \App\Services\Utilities\Files\Repository\Contracts\Repository::class,
            Repository::class
        );

        // LanguageRepository
        $this->app->bind(
            \App\Services\Utilities\LanguageRepository\Contracts\Repository::class,
            ConfigLanguageRepository::class
            );
    }
}
