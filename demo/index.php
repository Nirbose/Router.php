<?php

use Router\Route;

include '../vendor/autoload.php';
include './HomeController.php';

Route::get('/', function () {
    Route::redirect('about');
});

Route::get('/about', 'HomeController@about')->name('about');

Route::get('/contact', 'HomeController@contact')->name("contact");

Route::run();