<?php

namespace CatApi;

use CatApi\Image\Image;
use CatApi\Image\CachedImage;

class CatApi
{
    const CACHE_IMAGE_FILE_PATH = __DIR__ . '/../../cache/random';

    public function getRandomImage()
    {
        if (!file_exists(self::CACHE_IMAGE_FILE_PATH) || time() - filemtime(self::CACHE_IMAGE_FILE_PATH) > 3) {
            $image = new Image();

        }else{
            $image = new CachedImage();
        }

        return $image->getImageUrl(self::CACHE_IMAGE_FILE_PATH);
    }
}
