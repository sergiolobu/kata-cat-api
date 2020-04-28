<?php


namespace CatApi\File;

//Este nombre de interface tengo dudas
interface FileInterface
{
    public function get($url);
    public function put($filePath, $url);
}