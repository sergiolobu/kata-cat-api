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

        $catImage = $this->getCatImage();

        $cache->setImage($catImage);

        return $catImage;
    }

    private function getCatImage(): string
    {
        $responseXml = (new CatImageHttpClient())->requestImage();

        $catImage = (new CatImageXmlParser())->extractImage($responseXml);

        return $catImage;
    }
}
