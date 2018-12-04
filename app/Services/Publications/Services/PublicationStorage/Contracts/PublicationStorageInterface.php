<?php

namespace App\Services\Publications\Services\PublicationStorage\Contracts;

use App\Services\Utilities\Repository\Interfaces\Publishable;
use App\Services\Utilities\Repository\Interfaces\MainRepository;

interface PublicationStorageInterface
{
    /**
     * @param array $data
     * @param int $userId
     * @param string $editionNameKey
     * @param string $editionIdKey
     * @param Publishable $publication
     * @param MainRepository $edition
     * @return mixed
     */
    public function create(
        array $data,
        int $userId,
        string $editionNameKey,
        string $editionIdKey,
        MainRepository $publication,
        MainRepository $edition
    );

    /**
     * @param array $data
     * @param int $publicationId
     * @param string $editionNameKey
     * @param string $editionIdKey
     * @param MainRepository $publication
     * @param MainRepository $edition
     * @return mixed
     */
    public function update(
        array $data,
        int $publicationId,
        string $editionNameKey,
        string $editionIdKey,
        MainRepository $publication,
        MainRepository $edition
    );
}
