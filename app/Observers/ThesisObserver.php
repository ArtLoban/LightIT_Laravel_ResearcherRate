<?php

namespace App\Observers;

use App\Models\Publications\Theses\Thesis;
use App\Utilities\Repository\Interfaces\HasMorphRelations;
use App\Utilities\Observers\Contracts\MorphRelationsDeleteInterface;

class ThesisObserver
{
    /**
     * @var \App\Utilities\Observers\Contracts\MorphRelationsDeleteInterface
     */
    private $service;

    /**
     * ThesisObserver constructor.
     * @param MorphRelationsDeleteInterface $service
     */
    public function __construct(MorphRelationsDeleteInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Thesis $article
     * @return bool|mixed
     */
    public function deleted(Thesis $article)
    {
        return $article instanceof HasMorphRelations ? $this->service->deleteMorphRelations($article) : false;
    }
}
