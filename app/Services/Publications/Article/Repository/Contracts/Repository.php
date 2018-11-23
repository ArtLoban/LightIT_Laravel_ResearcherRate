<?php

namespace App\Services\Publications\Article\Repository\Contracts;

use App\Models\App\File;
use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface Repository extends MainRepository
{
    /**
     * @param int $id
     * @return File|null
     */
    public function getFileById(int $id): ?File;
}
