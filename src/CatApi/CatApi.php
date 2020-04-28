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
            throw new \Exception('http://cdn.my-cool-website.com/default.jpg');
        }

        $responseElement = new \SimpleXMLElement($responseXml);

        $catImage = (string)$responseElement->data->images[0]->image->url;
        return $catImage;
    }
}
