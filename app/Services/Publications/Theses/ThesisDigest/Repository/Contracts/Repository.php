<?php

namespace App\Services\Publications\Theses\ThesisDigest\Repository\Contracts;

use App\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param string $query
     * @return array|null
     */
    public function getDigestsNamesLikeQuery(string $query): ?array;
}
