<?php

namespace App\Observers;

use App\Models\App\File;
use Illuminate\Contracts\Filesystem\Filesystem as Storage;

class FileObserver
{
    /**
     * @var Storage
     */
    private $storage;

    /**
     * FileObserver constructor.
     * @param Storage $storage
     */
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param File $file
     * @param Storage $storage
     */
    public function deleted(File $file)
    {
        $editedPath = $this->editPath($file->path);
        $this->storage->delete($editedPath);
    }

    /**
     * @param string $path
     * @return string
     */
    public function editPath(string $path): string
    {
        return str_replace('storage', 'public', $path);
    }
}
