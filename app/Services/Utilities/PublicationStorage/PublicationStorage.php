<?php

namespace App\Services\Utilities\PublicationStorage;

use App\Services\Utilities\Files\Contracts\HasFile;
use App\Services\Utilities\Repository\Interfaces\Publishable;
use App\Services\Utilities\Repository\Interfaces\MainRepository;
use App\Services\Utilities\PublicationService\Contracts\PublicationServiceInterface;
use App\Services\Utilities\PublicationStorage\Contracts\PublicationStorageInterface;

class PublicationStorage implements PublicationStorageInterface
{
    /**
     * @var PublicationServiceInterface
     */
    private $publicationService;

    /**
     * StorageService constructor.
     * @param PublicationServiceInterface $publicationService
     */
    public function __construct(PublicationServiceInterface $publicationService)
    {
        $this->publicationService = $publicationService;
    }

    /**
     * @param array $data
     * @param int $userId
     * @param string $editionNameKey
     * @param string $editionIdKey
     * @param MainRepository $publication
     * @param MainRepository $edition
     * @return mixed|void
     */
    public function create(
        array $data,
        int $userId,
        string $editionNameKey,
        string $editionIdKey,
        MainRepository $publication,
        MainRepository $edition
    ) {
        $data['user_id'] = $userId;
        $data[$editionIdKey] = $this->getEditionIdByName($data[$editionNameKey], $edition);

        $createdPublication = $publication->create($data);

        $this->assignAuthors($data['authors'], $createdPublication);

        $this->storeFile($data, $createdPublication);
    }

    /**
     * @param array $data
     * @param int $publicationId
     * @param string $editionNameKey
     * @param string $editionIdKey
     * @param MainRepository $publication
     * @param MainRepository $edition
     * @return mixed|void
     */
    public function update(
        array $data,
        int $publicationId,
        string $editionNameKey,
        string $editionIdKey,
        MainRepository $publication,
        MainRepository $edition
    ) {
        $data[$editionIdKey] = $this->getEditionIdByName($data[$editionNameKey], $edition);

        $updatedPublication = $publication->updateById($publicationId, $data);

        $this->assignAuthors($data['authors'], $updatedPublication);

        $this->storeFile($data, $updatedPublication);
    }

    /**
     * @param string $editionName
     * @param MainRepository $edition
     * @return int
     */
    private function getEditionIdByName(string $editionName, MainRepository $edition): int
    {
        return $this->publicationService->getEditionIdByName($editionName, $edition);
    }

    /**
     * @param string $authors
     * @param Publishable $createdPublication
     */
    private function assignAuthors(string $authors, Publishable $createdPublication)
    {
        $this->publicationService->assignAuthors($authors, $createdPublication);
    }

    /**
     * @param array $data
     * @param HasFile $createdPublication
     */
    private function storeFile(array $data, HasFile $createdPublication)
    {
        if (!empty($data['file']) && $data['file']->isValid()) {
            $this->publicationService->storeFile($data['file'], $createdPublication);
        }
    }
}
