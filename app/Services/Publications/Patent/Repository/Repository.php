<?php

namespace App\Services\Publications\Patent\Repository;

use App\Models\Publications\Patents\Patent;
use App\Services\Publications\Patent\Repository\Contracts\Repository as PatentRepository;
use App\Services\Utilities\Repository\RepositoryAbstract;

class Repository extends RepositoryAbstract implements PatentRepository
{
    protected function getClassName(): string
    {
        return Patent::class;
    }
}