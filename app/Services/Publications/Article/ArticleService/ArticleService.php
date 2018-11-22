<?php

namespace App\Services\Publications\Article\ArticleService;

use App\Models\Publications\Articles\Article\Article;
use App\Services\Utilities\Files\FileUploader\FileUploader;
use App\Services\Publications\Author\Repository\Contracts\Repository as AuthorRepository;
use App\Services\Publications\Journal\Repository\Contracts\Repository as JournalRepository;
use App\Services\Publications\Article\Repository\Contracts\Repository as ArticleRepository;
use App\Services\Utilities\Repository\Interfaces\MainRepository;
use Illuminate\Http\UploadedFile;

abstract class ArticleService
{
    /**
     * @var JournalRepository
     */
    protected $journalRepository;

    /**
     * @var ArticleRepository
     */
    protected $articleRepository;

    /**
     * @var AuthorRepository
     */
    protected $authorRepository;

    /**
     * @var FileUploader
     */
    protected $fileUploader;

    /**
     * ArticleStorageService constructor.
     * @param JournalRepository $journalRepository
     */
    public function __construct(
        JournalRepository $journalRepository,
        ArticleRepository $articleRepository,
        AuthorRepository $authorRepository,
        FileUploader $fileUploader
    ) {
        $this->journalRepository = $journalRepository;
        $this->articleRepository = $articleRepository;
        $this->authorRepository = $authorRepository;
        $this->fileUploader = $fileUploader;
    }

    /**
     * @param $journalName
     * @param $journalRepository
     * @return int
     */
    protected function getJournalId(string $journalName, MainRepository $journalRepository): int
    {
        return $this->getModelId($journalName, $journalRepository);
    }

    /**
     * @param string $entityName
     * @param MainRepository $repository
     * @return int|null
     */
    protected function getModelId(string $entityName, MainRepository $repository): int
    {
        $entity = $repository->getByName($entityName);
        if (! $entity) {
            $entity = $repository->create(['name' => $entityName]);
        }

        return $entity ? $entity->getKey() : null;
    }

    /**
     * @param string $authors
     * @param Article $article
     */
    protected function assignAuthors(string $authors, Article $article): void
    {
        $ids = $this->getAuthorsIds($authors);
        $article->authors()->sync($ids);
    }

    /**
     * @param string $authors
     * @return array
     */
    protected function getAuthorsIds(string $authors): array
    {
        $authorNames = $this->transformString($authors);

        $authorsIds = [];
        foreach ($authorNames as $authorName) {
            $authorsIds[] = $this->getModelId($authorName, $this->authorRepository);
        };

        return $authorsIds;
    }

    /**
     * @param string $authors
     * @return array
     */
    protected function transformString(string $authors): array
    {
        $authorsList = explode(",", $authors);

        return array_map("trim", $authorsList);
    }

    /**
     * @param UploadedFile $file
     * @param Article $article
     */
    protected function storeFile(UploadedFile $file, Article $article)
    {
        $this->fileUploader->store($file, $article);
    }
}
