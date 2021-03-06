<?php

include_once '../vendor/autoload.php';
include_once './HomeController.php';

use Router\Router;
use Router\RouterInterface;

Router::get('/', function () {
    echo 'Hello world!';
});

Router::group('/post', function () {
    Router::get('/', function () {
        echo 'Hello worldeeee!';
    });

    Router::get('/test', function () {
        echo 'Hello';
    });

    Router::get('/{id}', function ($id) {
        echo '<a href="test/t">yo</a> !';
    });
});
