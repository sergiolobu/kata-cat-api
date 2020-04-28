<?php

namespace CatApi;

use CatApi\Cache\AbstractCache;

class CatApi
{
    private $cache;

    public function __construct(AbstractCache $cache)
    {
        $this->cache = $cache;
    }

    public function getRandomImage()
    {
        return $this->cache->getItemCache();
    }
}
