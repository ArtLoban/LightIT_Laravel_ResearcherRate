<?php

namespace App\Services\Publications\Articles\Article\Repository;

use Illuminate\Support\Collection;
use App\Models\Publications\Articles\Article;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Articles\Article\Repository\Contracts\Repository as ArticleRepository;

class Repository extends \App\Utilities\Repository\RepositoryAbstract implements ArticleRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Article::class;
    }

    /**
     * @param int $userId
     * @param int $publicationTypeId
     * @return Collection|null
     */
    public function getAllWithRelationsByUserIdAndType(int $userId, int $publicationTypeId): ?Collection
    {
        return $this->className::where('user_id', $userId)
            ->where('publication_type_id', $publicationTypeId)
            ->with($this->getRelations())
            ->get();
    }

    /**
     * @return array
     */
    private function getRelations(): array
    {
        return [
            'journal',
            'authors',
            'publicationType'
        ];
    }
}
