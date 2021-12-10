<?php

class HomeController {

    public function index($test, $test2) {
        return "
            <h1>Hello World !</h1>
            <p>$test : $test2</p>
            ";
    }

}