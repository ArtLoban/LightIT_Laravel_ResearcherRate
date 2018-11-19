<?php

namespace App\Services\Publications\Journal\Repository;

use App\Models\Publications\Articles\Journal\Journal;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Journal\Repository\Contracts\Repository as JournalRepository;

class Repository extends RepositoryAbstract implements JournalRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Journal::class;
    }
}
