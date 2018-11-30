<?php

namespace App\Services\Publications\Patent\StorageService;

use App\Services\Publications\Patent\StorageService\Contracts\StorageServiceInterface;
use App\Services\Utilities\Files\Contracts\HasFile;
use App\Services\Utilities\PublicationService\Contracts\PublicationServiceInterface;
use App\Services\Utilities\Repository\Interfaces\MainRepository;

class StorageService implements StorageServiceInterface
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
     * @param MainRepository $publication
     * @param MainRepository $edition
     * @return mixed|void
     */
    public function create(array $data, int $userId, MainRepository $publication, MainRepository $edition)
    {
        $data['user_id'] = $userId;
        $createdPatent = $publication->create($data);

        $this->publicationService->assignAuthors($data['authors'], $createdPatent);

        $this->storeFile($data, $createdPatent);
    }

    /**
     * @param array $data
     * @param int $patentId
     * @param MainRepository $publication
     * @param MainRepository $edition
     * @return mixed|void
     */
    public function update(array $data, int $patentId, MainRepository $publication, MainRepository $edition)
    {
        $updatedPatent = $publication->updateById($patentId, $data);

        $this->publicationService->assignAuthors($data['authors'], $updatedPatent);

        $this->storeFile($data, $updatedPatent);
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