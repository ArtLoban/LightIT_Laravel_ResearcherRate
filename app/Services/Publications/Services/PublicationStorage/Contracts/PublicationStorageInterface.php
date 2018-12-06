<?php

namespace App\Services\Publications\Services\PublicationStorage\Contracts;

use App\Utilities\Repository\Interfaces\Publishable;
use App\Utilities\Repository\Interfaces\MainRepository;

interface PublicationStorageInterface
{
    /**
     * @param array $data
     * @param int $userId
     * @param string $editionNameKey
     * @param string $editionIdKey
     * @param Publishable $publication
     * @param \App\Utilities\Repository\Interfaces\MainRepository $edition
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
     * @param \App\Utilities\Repository\Interfaces\MainRepository $publication
     * @param \App\Utilities\Repository\Interfaces\MainRepository $edition
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
