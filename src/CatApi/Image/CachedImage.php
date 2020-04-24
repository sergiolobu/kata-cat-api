<?php

namespace CatApi\Image;

use CatApi\Image\ImageInterface;

class CachedImage implements ImageInterface
{
    public function getImageUrl($cacheImageFilePath)
    {
        return file_get_contents($cacheImageFilePath);
    }
}