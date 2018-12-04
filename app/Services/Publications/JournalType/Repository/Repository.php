<?php

namespace App\Services\Publications\JournalType\Repository;

use App\Models\Publications\Articles\Journal\JournalType;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\JournalType\Repository\Contracts\Repository as JournalTypeRepository;

class Repository extends RepositoryAbstract implements JournalTypeRepository
{
    protected function getClassName(): string
    {
        return JournalType::class;
    }
}
