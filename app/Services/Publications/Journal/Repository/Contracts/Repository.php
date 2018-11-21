<?php

namespace App\Services\Publications\Journal\Repository\Contracts;

use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param string $query
     * @return array|null
     */
    public function getJournalNamesByAjaxQuery(string $query): ?array;
}
