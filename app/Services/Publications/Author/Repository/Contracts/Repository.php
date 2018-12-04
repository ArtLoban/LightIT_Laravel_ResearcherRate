<?php

namespace App\Services\Publications\Author\Repository\Contracts;

use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param string $query
     * @return array|null
     */
    public function getAuthorsNamesLikeQuery(string $query): ?array;
}
