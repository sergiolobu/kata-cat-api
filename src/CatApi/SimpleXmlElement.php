<?php


namespace CatApi;


class SimpleXmlElement
{
    public function getImageUrlOfXml($imageXml)
    {
        $responseElement = new \SimpleXMLElement($imageXml);

        return (string) $responseElement->data->images[0]->image->url;
    }
}