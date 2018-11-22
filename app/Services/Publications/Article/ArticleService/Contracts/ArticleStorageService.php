<?php

namespace App\Services\Publications\Article\ArticleService\Contracts;

interface ArticleStorageService
{
    /**
     * @param array $data
     * @param int $userId
     * @return mixed
     */
    public function store(array $data, int $userId);
}
