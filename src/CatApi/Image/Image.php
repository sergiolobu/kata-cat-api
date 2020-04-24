<?php

namespace CatApi\Image;

use CatApi\Image\ImageInterface;

class Image implements ImageInterface
{
    public function getImageUrl($cacheImageFilePath)
    {
        $imageXml = $this->getImageXML();

        $this->checkIfImageXmlIsNullAndReturnDefaultImage($imageXml);

        $responseElement = new \SimpleXMLElement($imageXml);

        $imageUrl = (string) $responseElement->data->images[0]->image->url;

        $this->setImageToCacheFile($cacheImageFilePath,$imageUrl);

        return $imageUrl;
    }

    protected function getImageXML()
    {
        return @file_get_contents(
            'http://thecatapi.com/api/images/get?format=xml&type=jpg'
        );
    }

    protected function checkIfImageXmlIsNullAndReturnDefaultImage($imageXml)
    {
        if (!$imageXml) {
            return 'http://cdn.my-cool-website.com/default.jpg';
        }
    }

    protected function setImageToCacheFile($cacheImageFilePath,string $imageUrl)
    {
        file_put_contents(
            $cacheImageFilePath,
            $imageUrl
        );
    }
}