<?php

namespace App\Services\Organization\Employees\AcademicTitle\Repository;

use App\Models\Organization\Employees\AcademicTitle;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Organization\Employees\AcademicTitle\Repository\Contracts\Repository as AcademicTitleRepository;

class Repository extends RepositoryAbstract implements AcademicTitleRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return AcademicTitle::class;
    }
}
