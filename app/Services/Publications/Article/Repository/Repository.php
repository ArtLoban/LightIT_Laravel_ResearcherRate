<?php

namespace App\Services\Publications\Article\Repository;

use App\Models\Publications\Articles\Article\Article;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Article\Repository\Contracts\Repository as ArticleRepository;

class Repository extends RepositoryAbstract implements ArticleRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Article::class;
    }

    /**
     * @param int $id
     * @return null|string
     */
    public function getFilePathById(int $id): ?string
    {
        $file = $this->whereId($id)->file;

        return $filePath = $file ? $file->path : null;
    }
}
