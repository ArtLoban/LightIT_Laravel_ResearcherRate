<?php

namespace App\Services\Publications\Article\Repository;

use Illuminate\Support\Collection;
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
