<?php

namespace App\Support\Storage;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Cache;

class StorageManager
{
    /**
     * in megabytes
     *
     * @var float
     */
    public $currentSize = 0;

    /**
     * max size of a storage
     *
     * @var float
     */
    public $maxSize;

    public $percentageTaken = 0;

    public function __construct()
    {
        $bytesSize = Cache::get('storage.size', 0);
        if(!$bytesSize){
            foreach(File::allFiles(storage_path()) as $fileInfo){
                $bytesSize += $fileInfo->getSize();
            }
            Cache::put('storage.size', $bytesSize, now()->addMinutes(10));
        }

        $this->currentSize = $bytesSize / (1024 ** 2);
        $this->maxSize = (float) config('filesystems.storage_max_size');

        $this->percentageTaken = round($this->currentSize / $this->maxSize * 100, 2);
    }
}
