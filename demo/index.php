<?php

use Router\Routes;

include '../vendor/autoload.php';
include './HomeController.php';

Routes::get('/about', 'HomeController@about');
Routes::get('/contact', 'HomeController@contact');

Routes::run();
