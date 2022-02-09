<?php

use Router\Route;

include '../vendor/autoload.php';
include './HomeController.php';

Route::get('/', function () {
    echo "Yo !";
});

Route::get('/about', 'HomeController@about');

Route::get('/contact', 'HomeController@contact');
