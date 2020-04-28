<?php

namespace CatApi;

class CatApi
{
    /**
     * @var CatImageCache
     */
    private $catImageCache;

    public function __construct()
    {
        $this->catImageCache = new CatImageCache(new FileCache());
    }

    public function getRandomImage()
    {
        return $this->catImageCache->getImage(function () {
            return (new GetCatImage())->execute();
        });
    }
}
