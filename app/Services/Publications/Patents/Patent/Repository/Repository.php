<?php

namespace App\Services\Publications\Patents\Patent\Repository;

use App\Models\Publications\Patents\Patent;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Patents\Patent\Repository\Contracts\Repository as PatentRepository;

class Repository extends RepositoryAbstract implements PatentRepository
{
    protected function getClassName(): string
    {
        return Patent::class;
    }
}