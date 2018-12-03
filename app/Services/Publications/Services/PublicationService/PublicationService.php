<?php

namespace App\Services\Publications\Services\PublicationService;

use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use App\Services\Utilities\Files\Contracts\HasFile;
use App\Services\Utilities\Files\FileUploader\FileUploader;
use App\Services\Utilities\Repository\Interfaces\Publishable;
use App\Services\Utilities\Repository\Interfaces\MainRepository;
use App\Services\Publications\Author\Repository\Contracts\Repository as AuthorRepository;
use App\Services\Publications\Services\PublicationService\Contracts\PublicationServiceInterface;

class PublicationService implements PublicationServiceInterface
{
    /**
     * @var AuthorRepository
     */
    private $authorRepository;

    /**
     * @var FileUploader
     */
    private $fileUploader;

    /**
     * ArticleService constructor.
     * @param AuthorRepository $authorRepository
     * @param FileUploader $fileUploader
     */
    public function __construct(AuthorRepository $authorRepository, FileUploader $fileUploader)
    {
        $this->authorRepository = $authorRepository;
        $this->fileUploader = $fileUploader;
    }

    /**
     * @param string $authors
     * @param Model $publication
     */
    public function assignAuthors(string $authors, Publishable $publication): void
    {
        $ids = $this->getAuthorsIds($authors);
        $publication->authors()->sync($ids);
    }

    /**
     * @param string $authors
     * @return array
     */
    private function getAuthorsIds(string $authors): array
    {
        $authorNames = $this->transformString($authors);

        $authorsIds = [];
        foreach ($authorNames as $authorName) {
            $authorsIds[] = $this->getEntityIdByName($authorName, $this->authorRepository);
        };

        return $authorsIds;
    }

    /**
     * @param string $editionName
     * @param MainRepository $repository
     * @return int
     */
    private function getEntityIdByName(string $entityName, MainRepository $repository): int
    {
        $entity = $repository->getByName($entityName);
        if (! $entity) {
            $entity = $repository->create(['name' => $entityName]);
        }

        return $entity ? $entity->getKey() : null;
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
     * @param HasFile $publication
     */
    public function storeFile(UploadedFile $file, HasFile $publication)
    {
        $this->fileUploader->store($file, $publication);
    }
}
