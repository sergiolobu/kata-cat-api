<?php

namespace CatApi\Image;

use CatApi\File\FileInterface;

class CachedImage implements ImageInterface
{
    protected $cacheImageFilePath;
    protected $file;

    public function __construct(FileInterface $file)
    {
        $this->cacheImageFilePath = __DIR__ . '/../../../cache/random';
        $this->file = $file;
    }

    public function getImageUrl()
    {
        return $this->file->get($this->cacheImageFilePath);
    }
}