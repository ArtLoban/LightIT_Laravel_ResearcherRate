<?php

namespace App\Services\Publications\Articles\JournalType\Repository;

use App\Models\Publications\Articles\Journal\JournalType;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Articles\JournalType\Repository\Contracts\Repository as JournalTypeRepository;

class Repository extends RepositoryAbstract implements JournalTypeRepository
{
    protected function getClassName(): string
    {
        return JournalType::class;
    }
}