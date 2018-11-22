<?php

namespace App\Services\Publications\Article\ArticleService\UpdateService;

use App\Services\Publications\Article\ArticleService\ArticleService;
use App\Services\Publications\Article\ArticleService\Contracts\ArticleUpdateService;

class UpdateService extends ArticleService implements ArticleUpdateService
{
    /**
     * @param int $articleId
     * @param array $data
     * @return mixed|void
     */
    public function update(int $articleId, array $data)
    {
        $data['journal_id'] = $this->getJournalId($data['journal_name'], $this->journalRepository);
        $updatedArticle = $this->articleRepository->updateById($articleId, $data);

        $this->assignAuthors($data['authors'], $updatedArticle);

        if (isset($data['file']) && $data['file']->isValid()) {
            $this->storeFile($data['file'], $updatedArticle);
        }
    }
}
