<?php

namespace App\Services\Organization\Facility\Department\Repository;

use App\Models\Organization\Facility\Department;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Organization\Facility\Department\Repository\Contracts\Repository as DepartmentRepository;

class Repository extends RepositoryAbstract implements DepartmentRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Department::class;
    }
}
