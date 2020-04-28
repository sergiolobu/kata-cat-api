<?php


namespace CatApi;


class CatImageXmlParser
{
    public function extractImage(string $xml)
    {
        $responseElement = new \SimpleXMLElement($xml);

        return (string)$responseElement->data->images[0]->image->url;
    }
}
