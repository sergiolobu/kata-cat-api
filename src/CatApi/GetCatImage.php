<?php


namespace CatApi;


class GetCatImage
{
    public function execute(): string
    {
        $responseXml = (new CatImageHttpClient())->requestImage();

        $catImage = (new CatImageXmlParser())->extractImage($responseXml);

        return $catImage;
    }
}
