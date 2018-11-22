<?php

namespace App\Services\Publications\Article\ArticleService\Contracts;

interface ArticleUpdateService
{
    /**
     * @param int $articleId
     * @param array $data
     * @return mixed
     */
    public function update(int $articleId, array $data);
}
