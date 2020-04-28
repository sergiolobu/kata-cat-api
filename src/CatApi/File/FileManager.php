<?php


namespace CatApi\File;

//TODO este nombre de clase tengo dudas.
class FileManager implements FileInterface
{
    public function get($url)
    {
        return file_get_contents($url);
    }

    public function put($filePath, $url)
    {
        file_put_contents(
            $filePath,
            $url
        );
    }
}