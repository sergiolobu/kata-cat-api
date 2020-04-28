<?php


namespace CatApi;


class FileCache
{
    /**
     * @var string
     */
    private $cacheFilename;

    public function __construct()
    {
        $this->cacheFilename = __DIR__ . '/../../cache/random';
    }

    public function isValid(): bool
    {
        return $this->existCache() || $this->cacheHasExpired();
    }

    public function getImage()
    {
        return file_get_contents($this->cacheFilename);
    }

    public function setImage(string $catImage)
    {
        file_put_contents($this->cacheFilename, $catImage);

    }

    private function existCache(): bool
    {
        return !file_exists($this->cacheFilename);
    }

    private function cacheHasExpired(): bool
    {
        return time() - filemtime($this->cacheFilename) > 3;
    }
}
