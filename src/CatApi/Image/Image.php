<?php

namespace CatApi\Image;

use CatApi\File\FileInterface;
use CatApi\SimpleXmlElement;

class Image implements ImageInterface
{
    protected $cacheImageFilePath;
    protected $file;
    protected $simpleXMlElement;

    public function __construct(FileInterface $file, SimpleXmlElement $simpleXMlElement)
    {
        $this->cacheImageFilePath = __DIR__ . '/../../../cache/random';
        $this->file = $file;
        $this->simpleXMlElement = $simpleXMlElement;
    }

    public function getImageUrl()
    {
        try {
            $responseXml = $this->getResponseXML();
        }catch (\Exception $e){
            return 'http://cdn.my-cool-website.com/default.jpg';
        }

        $imageUrl =  $this->simpleXMlElement->getImageUrlOfXml($responseXml);

        $this->putImageInCacheFile($imageUrl);

        return $imageUrl;
    }

    protected function getResponseXML()
    {
        return $this->file->get(
            'http://thecatapi.com/api/images/get?format=xml&type=jpg'
        );
    }

    protected function putImageInCacheFile(string $imageUrl)
    {
        $this->file->put(
            $this->cacheImageFilePath,
            $imageUrl
        );
    }
}