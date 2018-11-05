<?php

namespace App\Services\Organization\Employees\Profile\Repository;

use App\Models\Organization\Employees\Profile;
use App\Services\Utilities\Repository\RepositoryAbstract;
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
}
