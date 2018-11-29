<?php

namespace App\Services\Publications\Patent\StorageService\Contracts;

use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface StorageServiceInterface
{
    public function create(array $data, int $userId, MainRepository $publication, MainRepository $edition);

    public function update();
}