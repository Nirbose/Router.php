<?php

include_once '../vendor/autoload.php';

use Router\RouteCollector;
use Router\Router;

Router::get('/', function () {
    echo 'Hello world!';
});

Router::group('/post', function (RouteCollector $route) {
    $route->get('/', function () {
        echo 'All Post!';
    });

    $route->get('/{id}', function ($id) {
        echo 'Post number ' . $id;
    });
});
