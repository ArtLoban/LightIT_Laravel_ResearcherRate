<?php

namespace App\Services\Publications\Patents\Patent\Repository;

use App\Models\Publications\Patents\Patent;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Patents\Patent\Repository\Contracts\Repository as PatentRepository;

class Repository extends \App\Utilities\Repository\RepositoryAbstract implements PatentRepository
{
    protected function getClassName(): string
    {
        return Patent::class;
    }
}