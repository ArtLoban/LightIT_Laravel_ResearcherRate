<?php

namespace App\Services\Publications\Article\Repository\Contracts;

interface Repository
{
    public function createNewArticle(array $request, $storeHandler);
}
