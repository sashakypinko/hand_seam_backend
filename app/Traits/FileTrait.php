<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileTrait
{

    /**
     * @param $file
     * @return string
     */
    public function saveFile($file): string
    {
        $fileName = $this->getFileName($file);
        $file->storeAs($this->getDirectoryPath(), $fileName);

        return $this->getFilePath() . '/' . $fileName;
    }

    /**
     * @param $field
     */
    public function deleteFile($file): void
    {
        Storage::delete('public/' . $file);
    }

    /**
     * @return string
     */
    public function getFilePath(): string
    {
        return 'files/' . $this->getDirectoryName();
    }

    /**
     * @param string $imageUrl
     * @return string
     */
    public static function getImagePath(string $imageUrl): string
    {
        return config('app')['url'] . '/storage/' . $imageUrl;
    }

    /**
     * @param $file
     * @return string
     */
    protected function getFileName($file): string
    {
        return uniqid() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
    }

    /**
     * @param bool $public
     * @return string
     */
    protected function getDirectoryPath($public = true): string
    {
        $paths = config('files.paths');

        return ($public ? $paths['public'] : $paths['storage']) . '/'
            . $this->getDirectoryName();
    }

    /**
     * @return string
     */
    protected function getDirectoryName(): string
    {
        return Str::lower(class_basename(get_class($this)));
    }
}
