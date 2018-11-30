<?php

namespace App\Services\Utilities\Files\FileDownloader\Contracts;

use App\Services\Utilities\Files\Contracts\HasFile;

interface FileDownloaderInterface
{
    /**
     * Http response method name
     * file() method - display a file, such as an image or PDF, directly in the user's browser
     */
    const FILE = 'file';

    /**
     * Http response method name
     * download() method - forces the user's browser to download the file at the given path
     */
    const DOWNLOAD = 'download';

    /**
     * @param HasFile|null $fileOwner
     * @param string $methodName
     * @return mixed
     */
    public function fetchFile(?HasFile $fileOwner, string $methodName);
}