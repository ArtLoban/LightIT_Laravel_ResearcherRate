<?php

namespace App\Services\Publications\Article\ArticleStorageService;

use App\Models\Publications\Articles\Article\Article;
use App\Services\Publications\Author\Repository\Contracts\Repository as AuthorRepository;
use App\Services\Publications\Journal\Repository\Contracts\Repository as JournalRepository;
use App\Services\Publications\Article\Repository\Contracts\Repository as ArticleRepository;
use App\Services\Publications\Article\ArticleStorageService\Contracts\ArticleStorageService as ArticleStorage;
use App\Services\Utilities\Files\FileUploader\FileUploader;
use App\Services\Utilities\Repository\Interfaces\MainRepository;
use Illuminate\Http\UploadedFile;

class ArticleStorageService implements ArticleStorage
{
    /**
     * @var JournalRepository
     */
    private $journalRepository;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var FileUploader
     */
    private $fileUploader;

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
     * @param array $data
     */
    public function store(array $data)
    {
        $data['journal_id'] = $this->getJournalId($data['journal_name'], $this->journalRepository);
        $createdArticle = $this->articleRepository->create($data);

        $this->assignAuthors($data['authors'], $createdArticle);

        if (isset($data['file']) && $data['file']->isValid()) {
            $this->storeFile($data['file'], $createdArticle);
        }
    }

    /**
     * @param $journalName
     * @param $journalRepository
     * @return int
     */
    private function getJournalId(string $journalName, MainRepository $journalRepository): int
    {
        return $this->getModelId($journalName, $journalRepository);
    }

    /**
     * @param string $entityName
     * @param MainRepository $repository
     * @return int|null
     */
    private function getModelId(string $entityName, MainRepository $repository): int
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
    private function assignAuthors(string $authors, Article $article): void
    {
        $ids = $this->getAuthorsIds($authors);
        $article->authors()->attach($ids);
    }

    private function getAuthorsIds(string $authors): array
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
    private function transformString(string $authors): array
    {
        $authorsList = explode(",", $authors);

        return array_map("trim", $authorsList);
    }

    /**
     * @param UploadedFile $file
     * @param Article $article
     */
    private function storeFile(UploadedFile $file, Article $article)
    {
        $this->fileUploader->store($file, $article);
    }
}
