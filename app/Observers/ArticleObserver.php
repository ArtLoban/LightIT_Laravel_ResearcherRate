<?php

namespace App\Observers;

use App\Models\Publications\Articles\Article\Article;
use App\Services\Utilities\Repository\Interfaces\HasMorphRelations;
use App\Services\Utilities\Observers\Contracts\MorphRelationsDeleteInterface;

class ArticleObserver
{
    /**
     * @var MorphRelationsDeleteInterface
     */
    private $service;

    /**
     * UserObserver constructor.
     * @param MorphRelationsDeleteInterface $service
     */
    public function __construct(MorphRelationsDeleteInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @param Article $article
     * @return bool|mixed
     */
    public function deleted(Article $article)
    {
        return $article instanceof HasMorphRelations ? $this->service->deleteMorphRelations($article) : false;
    }
}
