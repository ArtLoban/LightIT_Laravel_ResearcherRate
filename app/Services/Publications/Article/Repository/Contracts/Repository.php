<?php

namespace App\Services\Publications\Article\Repository\Contracts;

use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param int $id
     * @return null|string
     */
    public function getFilePathById(int $id): ?string;
}
