<?php

namespace App\Services\Publications\Services\PublicationService;

use App\Utilities\Repository\Interfaces\MainRepository;

class EditionIdByName
{
    /**
     * @param string $editionName
     * @param \App\Utilities\Repository\Interfaces\MainRepository $repository
     * @return int
     */
    public function getEditionIdByName(string $editionName, MainRepository $repository): int
    {
        $entity = $repository->getByName($editionName);
        if (! $entity) {
            $entity = $repository->create(['name' => $editionName]);
        }

        return $entity ? $entity->getKey() : null;
    }
}
