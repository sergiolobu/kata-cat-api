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

        $responseElement = new \SimpleXMLElement($responseXml);

        $catImage = (string)$responseElement->data->images[0]->image->url;

        return $catImage;
    }
}
