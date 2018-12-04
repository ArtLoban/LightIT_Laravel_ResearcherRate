<?php

namespace App\Services\Publications\Patents\Patent\StorageService\Contracts;

use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface StorageServiceInterface
{
    /**
     * @param array $data
     * @param int $userId
     * @param MainRepository $publication
     * @param MainRepository $edition
     * @return mixed
     */
    public function create(array $data, int $userId, MainRepository $publication, MainRepository $edition);

    /**
     * @param array $data
     * @param int $patentId
     * @param MainRepository $publication
     * @param MainRepository $edition
     * @return mixed
     */
    public function update(array $data, int $patentId, MainRepository $publication, MainRepository $edition);
}
