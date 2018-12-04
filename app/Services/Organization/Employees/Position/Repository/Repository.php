<?php

namespace App\Services\Organization\Employees\Position\Repository;

use App\Models\Organization\Employees\Position;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Organization\Employees\Position\Repository\Contracts\Repository as PositionRepository;

class Repository extends RepositoryAbstract implements PositionRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Position::class;
    }
}
