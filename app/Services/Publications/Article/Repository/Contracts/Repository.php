<?php

namespace App\Services\Publications\Article\Repository\Contracts;

use Illuminate\Support\Collection;
use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param int $userId
     * @param int $publicationTypeId
     * @return Collection|null
     */
    public function getAllWithRelationsByUserIdAndType(int $userId, int $publicationTypeId): ?Collection;
}
