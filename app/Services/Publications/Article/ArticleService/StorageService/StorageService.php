<?php

namespace App\Services\Publications\Article\ArticleService\StorageService;

use App\Services\Publications\Article\ArticleService\ArticleService;
use App\Services\Publications\Article\ArticleService\Contracts\ArticleStorageService;

class StorageService extends ArticleService implements ArticleStorageService
{
    /**
     * @param array $data
     * @param int $userId
     * @return mixed|void
     */
    public function store(array $data, int $userId)
    {
        $data['user_id'] = $userId;
        $data['journal_id'] = $this->getJournalId($data['journal_name'], $this->journalRepository);

        $createdArticle = $this->articleRepository->create($data);

        $this->assignAuthors($data['authors'], $createdArticle);

        if (isset($data['file']) && $data['file']->isValid()) {
            $this->storeFile($data['file'], $createdArticle);
        }
    }
}
