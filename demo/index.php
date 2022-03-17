<?php

include_once '../vendor/autoload.php';
include_once './HomeController.php';

use Router\Router;
use Router\RouterInterface;

Router::get('/', function () {
    echo 'Hello world!';
});

Router::group('/post', function (RouterInterface $route) {
    $route::get('/e', function () {
        echo 'Hello worldeeee!';
    });

    $route::get('/f', [HomeController::class, 'about']);
});
