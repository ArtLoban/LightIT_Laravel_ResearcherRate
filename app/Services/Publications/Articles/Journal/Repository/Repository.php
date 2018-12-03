<?php

namespace App\Services\Publications\Articles\Journal\Repository;

use App\Models\Publications\Articles\Journal\Journal;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Articles\Journal\Repository\Contracts\Repository as JournalRepository;

class Repository extends RepositoryAbstract implements JournalRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Journal::class;
    }

    /**
     * @param string $query
     * @return array|null
     */
    public function getJournalsNamesLikeQuery(string $query): ?array
    {
        return $this->where('name', 'like', '%' . $query . '%')->pluck('name')->all();
    }
}