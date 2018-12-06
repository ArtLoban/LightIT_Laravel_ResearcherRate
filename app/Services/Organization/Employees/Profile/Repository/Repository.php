<?php

namespace App\Services\Organization\Employees\Profile\Repository;

use Illuminate\Support\Collection;
use App\Models\Organization\Employees\Profile;
use App\Utilities\Repository\RepositoryAbstract;
use \App\Services\Organization\Employees\Profile\Repository\Contracts\Repository as ProfileRepository;

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
     * @param Profile|null $profile
     * @return Collection
     */
    public function getProfilesBySameDepartment(?Profile $profile): Collection
    {
        return $profile
            ? $this->allWithRelationsByDepartmentId($profile->department->id)
            : $this->allWithRelations($this->getRelations());
    }

    /**
     * @param int $departmentId
     * @return mixed
     */
    private function allWithRelationsByDepartmentId(int $departmentId)
    {
        return $this->className::with($this->getRelations())->where('department_id', $departmentId)->get();
    }

    /**
     * @return array
     */
    private function getRelations(): array
    {
        return [
            'academicDegree',
            'academicTitle',
            'position',
            'department',
            'user'
        ];
    }
}
