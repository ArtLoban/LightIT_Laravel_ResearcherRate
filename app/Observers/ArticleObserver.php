<?php

namespace App\Observers;

use App\Models\Publications\Articles\Article;
use App\Utilities\Repository\Interfaces\HasMorphRelations;
use App\Utilities\Observers\Contracts\MorphRelationsDeleteInterface;

class ArticleObserver
{
    /**
     * @var \App\Utilities\Observers\Contracts\MorphRelationsDeleteInterface
     */
    private $service;

    /**
     * ArticleObserver constructor.
     * @param \App\Utilities\Observers\Contracts\MorphRelationsDeleteInterface $service
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
