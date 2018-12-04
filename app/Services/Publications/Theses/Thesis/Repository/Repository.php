<?php

namespace App\Services\Publications\Theses\Thesis\Repository;

use Illuminate\Support\Collection;
use App\Models\Publications\Theses\Thesis;
use App\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Theses\Thesis\Repository\Contracts\Repository as ThesisRepository;

class Repository extends RepositoryAbstract implements ThesisRepository
{
    protected function getClassName(): string
    {
        return Thesis::class;
    }

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
            'thesisDigest',
            'authors',
            'publicationType'
        ];
    }
}
