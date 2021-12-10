<?php

use Router\Router;

include './vendor/autoload.php';
include './HomeController.php';

$router = new Router();

$router::get('/about/{test}/{moi}', 'HomeController@index');
