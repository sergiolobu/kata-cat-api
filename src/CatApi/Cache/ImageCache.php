<?php


namespace CatApi\Cache;

use CatApi\File\FileManager;
use CatApi\Image\CachedImage;
use CatApi\Image\Image;
use CatApi\SimpleXmlElement;

class ImageCache implements AbstractCache
{
    private $cacheImageFilePath;

    public function __construct()
    {
        $this->cacheImageFilePath = __DIR__ . '/../../../cache/random';
    }

    public function getItemCache()
    {
        $fileManager = new FileManager();

        if ($this->isAvailable()) {
            $simpleXmlElement = new SimpleXmlElement();
            $image = new Image($fileManager,$simpleXmlElement);

            return $image->getImageUrl();
        }

        $cachedImage = new CachedImage($fileManager);
        return $cachedImage->getImageUrl();
    }

    public function isAvailable()
    {
        return !file_exists($this->cacheImageFilePath) || time() - filemtime($this->cacheImageFilePath) > 3;
    }
}