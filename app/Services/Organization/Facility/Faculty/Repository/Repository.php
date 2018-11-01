<?php

namespace App\Services\Organization\Facility\Faculty\Repository;

use App\Models\Organization\Facility\Faculty;
use App\Services\Organization\Facility\Faculty\Repository\Contracts\Repository as FacultyRepository;
use App\Services\Utilities\Repository\RepositoryAbstract;

class Repository extends RepositoryAbstract implements FacultyRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Faculty::class;
    }
}
