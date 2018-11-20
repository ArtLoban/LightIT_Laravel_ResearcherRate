<?php

namespace App\Services\Utilities\Files\FileUploader;

use App\Models\App\File;
use Illuminate\Http\UploadedFile;
use App\Services\Utilities\Files\Contracts\HasFile;
use App\Services\Utilities\Files\Repository\Contracts\Repository as FileRepository;

class FileUploader
{
    const PATH = 'public/uploads/files';

    /**
     * @var FileRepository
     */
    private $fileRepository;

    /**
     * FileUploader constructor.
     * @param FileRepository $fileRepository
     */
    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param HasFile $owner
     * @return mixed
     */
    public function store(UploadedFile $uploadedFile, HasFile $owner)
    {
        $params = $this->getStoreParams($uploadedFile, $owner);

        return $this->fileRepository->create($params);
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param HasFile $owner
     * @return array
     */
    private function getStoreParams(UploadedFile $uploadedFile, HasFile $owner): array
    {
        return [
            File::PATH => $this->getPath($uploadedFile),
            'extension' => $uploadedFile->extension(),
            File::FILEABLE_TYPE => $owner->ownerType(),
            File::FILEABLE_ID => $owner->ownerId(),
        ];
    }

    /**
     * @param UploadedFile $uploadedFile
     * @return string
     */
    private function getPath(UploadedFile $uploadedFile): string
    {
        $path = $uploadedFile->store(self::PATH);

        return $this->editStoragePath($path);
    }

    /**
     * @param string $path
     * @return string
     */
    private function editStoragePath(string $path): string
    {
        return str_replace('public', 'storage', $path);
    }
}
