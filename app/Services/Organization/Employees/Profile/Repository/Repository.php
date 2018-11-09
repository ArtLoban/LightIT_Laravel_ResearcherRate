<?php

namespace App\Services\Organization\Employees\Profile\Repository;

use App\Models\Organization\Employees\Profile;
use App\Services\Utilities\Repository\RepositoryAbstract;
use \App\Services\Organization\Employees\Profile\Repository\Contracts\Repository as ProfileRepository;
use Illuminate\Support\Collection;

class Repository extends RepositoryAbstract implements ProfileRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Profile::class;
    }

    /**
     * @param int $id
     * @param array $relations
     * @return mixed
     */
    public function getAllWithRelationsByDepartmentId(int $departmentId, array $relations)
    {
        return $this->className::with($relations)->where('department_id', $departmentId)->get();
    }

    public function getProfilesBySameDepartment(?Profile $profile, array $relations): Collection
    {
        return $profile
            ? $this->className::with($relations)->where('department_id', $profile->department->id)->get()
            : $this->allWithRelations($relations);
    }
}
