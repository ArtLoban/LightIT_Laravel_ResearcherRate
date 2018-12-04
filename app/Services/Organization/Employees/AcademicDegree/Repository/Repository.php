<?php

namespace App\Services\Organization\Employees\AcademicDegree\Repository;

use App\Models\Organization\Employees\AcademicDegree;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Organization\Employees\AcademicDegree\Repository\Contracts\Repository as AcademicDegreeRepository;

class Repository extends RepositoryAbstract implements AcademicDegreeRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return AcademicDegree::class;
    }
}
