<?php

namespace App\Services\Publications\Article\ArticleStorageService\Contracts;

interface ArticleStorageService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data);
}
