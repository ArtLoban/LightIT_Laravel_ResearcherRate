<?php

namespace App\Services\Utilities\Files\FileDownloader;

use App\Models\App\File;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Services\Utilities\Files\Contracts\HasFile;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Contracts\Filesystem\Filesystem as Storage;
use App\Services\Utilities\Files\FileDownloader\Contracts\FileDownloaderInterface;

class FileDownloader implements FileDownloaderInterface
{
    /**
     * @var
     */
    private $storage;

    /**
     * @var ResponseFactory
     */
    private $response;

    /**
     * FileDownloader constructor.
     * @param $storage
     * @param ResponseFactory $response
     */
    public function __construct(Storage $storage, ResponseFactory $response)
    {
        $this->storage = $storage;
        $this->response = $response;
    }

    /**
     * @param HasFile|null $fileOwner
     * @param string $methodName
     * @return \Illuminate\Http\Response|mixed
     */
    public function fetchFile(?HasFile $fileOwner, string $methodName)
    {
        if (! $fileOwner) {
            throw new ModelNotFoundException();
        }
        $file = $fileOwner->getFile();

        return $this->fetchOrFail($file, $methodName);
    }

    /**
     * file() method - display a file, such as an image or PDF, directly in the user's browser
     * download() method - forces the user's browser to download the file at the given path
     *
     * @param File|null $file
     * @param string $methodName
     * @return \Illuminate\Http\Response
     */
    private function fetchOrFail(?File $file, string $methodName)
    {
        if ($file && $this->storage->exists($file->getActualPath())) {
            return $this->response->{$methodName}($file->path);
        }

        return $this->response->view('cabinet.errors.file_not_found');
    }
}