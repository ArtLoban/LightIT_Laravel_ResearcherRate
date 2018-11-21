<?php

namespace App\Services\Publications\Author\Repository;

use App\Models\Publications\Author;
use App\Services\Utilities\Repository\RepositoryAbstract;
use App\Services\Publications\Author\Repository\Contracts\Repository as AuthorRepository;

class Repository extends RepositoryAbstract implements AuthorRepository
{
    /**
     * @return string
     */
    protected function getClassName(): string
    {
        return Author::class;
    }

    /**
     * @param string $query
     * @return array|null
     */
    public function getAuthorNamesByAjaxQuery(string $query): ?array
    {
        return $this->where('name', 'like', '%' . $query . '%')->pluck('name')->all();
    }
}
