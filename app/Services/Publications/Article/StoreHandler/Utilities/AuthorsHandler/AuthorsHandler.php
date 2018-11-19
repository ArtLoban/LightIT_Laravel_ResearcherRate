<?php

namespace App\Services\Publications\Article\StoreHandler\Utilities\AuthorsHandler;

use App\Services\Publications\Author\Repository\Contracts\Repository as AuthorRepository;
use App\Services\Publications\Article\StoreHandler\Utilities\AuthorsHandler\Interfaces\AuthorsHandler as AuthorsHandlerInterfaces;
use Illuminate\Database\Eloquent\Model;

class AuthorsHandler implements AuthorsHandlerInterfaces
{
    private $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function assign(string $authors, Model $article)
    {
        $authorsArray = $this->transformString($authors);
        $sortedAuthorsData = $this->sortData($authorsArray);

//        $article->authors()->attach($sortedAuthorsData['ids']);

        die('Ok!');
        return null;
    }

    /**
     * @param string $authors
     * @return array
     */
    private function transformString(string $authors): array
    {
        $authorsList = explode(",", $authors);
        $result = array_map("trim", $authorsList);

        return $result;
    }

    /**
     * @param array $authorsData
     * @return array
     */
    private function sortData(array $authorsData): array
    {
        $authors = [];

        foreach ($authorsData as $authorItem) {
            $this->checkIfInteger((int) $authorItem) ?
                $authors['ids'][] = $authorItem :
                $authors['names'][] = $authorItem;
        }

        return $authors;
    }

    /**
     * @param int $value
     * @return bool
     */
    private function checkIfInteger(int $value): bool
    {
        if (is_int($value) && $value !== 0) {
            return true;
        }

        return false;
    }
}
