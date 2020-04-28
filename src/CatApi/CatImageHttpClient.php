<?php


namespace CatApi;


class CatImageHttpClient
{
    public function requestImage(): string
    {
        $response = @file_get_contents('http://thecatapi.com/api/images/get?format=xml&type=jpg');

        if (!$response) {
            // the cat API is down or something
            throw new \Exception('http://cdn.my-cool-website.com/default.jpg');
        }

        return $response;
    }
}
