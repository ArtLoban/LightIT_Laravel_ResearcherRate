<?php

namespace App\Services\Publications\Theses\Thesis\Repository;

use App\Models\Publications\Theses\Thesis;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Theses\Thesis\Repository\Contracts\Repository as ThesisRepository;

class Repository extends \App\Utilities\Repository\RepositoryAbstract implements ThesisRepository
{
    protected function getClassName(): string
    {
        return Thesis::class;
    }
}
