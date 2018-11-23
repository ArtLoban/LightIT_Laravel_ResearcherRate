<?php

namespace App\Services\Publications\Article\Repository;

use App\Models\App\File;
use App\Models\Publications\Articles\Article\Article;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Article\Repository\Contracts\Repository as ArticleRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
     * @return File|null
     */
    public function getFileById(int $id): ?File
    {
        /**
         * @var Article $arcticle
         */
        $arcticle = $this->whereId($id);
        if (! $arcticle) {
            throw new ModelNotFoundException();
        }

        return $arcticle->getFile();
    }
}
