<?php

namespace App\Utilities\Files\FileUploader;

use App\Models\App\File;
use Illuminate\Http\UploadedFile;
use App\Utilities\Files\Contracts\HasFile;
use App\Utilities\Files\Repository\Contracts\Repository;

class FileUploader
{
    const PATH = 'public/uploads/files';

    /**
     * @var Repository
     */
    private $fileRepository;

    /**
     * FileUploader constructor.
     * @param Repository $fileRepository
     */
    public function __construct(Repository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param \App\Utilities\Files\Contracts\HasFile $owner
     * @return mixed
     */
    public function store(UploadedFile $uploadedFile, HasFile $owner)
    {
        $params = $this->getStoreParams($uploadedFile, $owner);
        $this->removePreviousFile($owner);

        return $this->fileRepository->create($params);
    }

    /**
     * @param UploadedFile $uploadedFile
     * @param \App\Utilities\Files\Contracts\HasFile $owner
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

    /**
     * @param \App\Utilities\Files\Contracts\HasFile $model
     * @return bool|null
     */
    private function removePreviousFile(HasFile $model): ?bool
    {
        if ($model->getFile()) {
            return $this->fileRepository->delete($model->getFile());
        }

        return false;
    }
}
