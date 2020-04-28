<?php

namespace CatApi;

class CatApi
{
    public function getRandomImage()
    {
        $cacheFilename = __DIR__ . '/../../cache/random';
        if (!$this->isCacheValid($cacheFilename)) {
            return $this->getCacheImage($cacheFilename);
        }

        $catImage = $this->getCatImage();

        $this->setCacheImage($cacheFilename, $catImage);

        return $catImage;
    }

    /**
     * @param string $cacheFilename
     * @return bool
     */
    private function cacheHasExpired(string $cacheFilename): bool
    {
        return time() - filemtime($cacheFilename) > 3;
    }

    /**
     * @param string $cacheFilename
     * @return bool
     */
    private function existCache(string $cacheFilename): bool
    {
        return !file_exists($cacheFilename);
    }

    /**
     * @param string $cacheFilename
     * @return bool
     */
    private function isCacheValid(string $cacheFilename): bool
    {
        return $this->existCache($cacheFilename) || $this->cacheHasExpired($cacheFilename);
    }

    /**
     * @return string
     */
    private function getCatImage(): string
    {
        $responseXml = @file_get_contents(
            'http://thecatapi.com/api/images/get?format=xml&type=jpg'
        );
        if (!$responseXml) {
            // the cat API is down or something
//            return 'http://cdn.my-cool-website.com/default.jpg';
        }

        $responseElement = new \SimpleXMLElement($responseXml);

        $catImage = (string)$responseElement->data->images[0]->image->url;
        return $catImage;
    }

    /**
     * @param string $cacheFilename
     * @return false|string
     */
    private function getCacheImage(string $cacheFilename)
    {
        return file_get_contents($cacheFilename);
    }

    /**
     * @param string $cacheFilename
     * @param string $catImage
     */
    private function setCacheImage(string $cacheFilename, string $catImage): void
    {
        file_put_contents($cacheFilename, $catImage);
    }
}
