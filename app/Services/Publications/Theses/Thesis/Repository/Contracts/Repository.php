<?php

namespace App\Services\Publications\Theses\Thesis\Repository\Contracts;

use Illuminate\Support\Collection;
use App\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param int $userId
     * @param int $publicationTypeId
     * @return Collection|null
     */
    public function getAllWithRelationsByUserIdAndType(int $userId, int $publicationTypeId): ?Collection;
}