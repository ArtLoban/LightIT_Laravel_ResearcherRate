<?php

namespace App\Services\Publications\Article\StoreHandler\Utilities\AuthorsHandler\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface AuthorsHandler
{
    /**
     * @param string $authors
     * @param int $articleId
     * @return mixed
     */
    public function assign(string $authors, Model $article);
}
