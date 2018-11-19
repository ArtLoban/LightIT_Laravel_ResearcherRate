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

    // Journal Id handler
    // Author list handler
    // File uploader handler
    public function createNewArticle(array $request, $storeHandler)
    {
//        dd($request);
        $request['journal_id'] = $storeHandler->getJournalId($request['journal_name']);
        $createdArticle = $this->create($request);

        $storeHandler->assignAuthors($request['authors'], $createdArticle);

        return null;
    }
}
