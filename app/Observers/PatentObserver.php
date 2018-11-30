<?php

namespace App\Observers;

use App\Models\Publications\Patents\Patent;
use App\Services\Utilities\Repository\Interfaces\HasMorphRelations;
use App\Services\Utilities\Observers\Contracts\MorphRelationsDeleteInterface;

class PatentObserver
{
    /**
     * @var MorphRelationsDeleteInterface
     */
    private $service;

    /**
     * PatentObserver constructor.
     * @param MorphRelationsDeleteInterface $service
     */
    public function __construct(MorphRelationsDeleteInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Patent $patent
     * @return bool|mixed
     */
    public function deleted(Patent $patent)
    {
        return $patent instanceof HasMorphRelations ? $this->service->deleteMorphRelations($patent) : false;
    }
}
