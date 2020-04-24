<?php

require __DIR__  . '/vendor/autoload.php';

use CatApi\CatApi;

$catApi = new CatApi();

echo 'A random URL of a cat gif: ' . $catApi->getRandomImage() . "\n";
