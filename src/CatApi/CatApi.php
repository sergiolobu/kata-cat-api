<?php

namespace CatApi;

class CatApi
{
    public function getRandomImage()
    {
        $cache = new FileCache();
        if (!$cache->isValid()) {
            return $cache->getImage();
        }

        $catImage = (new GetCatImage())->execute();

        $cache->setImage($catImage);

        return $catImage;
    }
}
