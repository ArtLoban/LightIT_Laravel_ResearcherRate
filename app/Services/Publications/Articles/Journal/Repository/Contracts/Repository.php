<?php

namespace App\Services\Publications\Articles\Journal\Repository\Contracts;

use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param string $query
     * @return array|null
     */
    public function getJournalsNamesLikeQuery(string $query): ?array;
}