<?php


namespace CatApi;


class CatImageCache
{
    /**
     * @var FileCache
     */
    private $cache;

    public function __construct(FileCache $cache)
    {
        $this->cache = $cache;
    }

    public function getImage(Callable $getRealImageCallable): string
    {
        if (!$this->cache->isValid()) {
            return $this->cache->getImage();
        }

        $catImage = $getRealImageCallable();
        $this->cache->setImage($catImage);

        return $catImage;
    }
}
