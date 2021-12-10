<?php

namespace Router;

class Router {

    public $url;
    public $routes = [];

    public function __construct()
    {
        $this->url = trim($_SERVER['REQUEST_URI'], '/');
    }

    private static function new(): Router
    {
        return new static();
    }

    public static function get($path, $action) {
        self::new()->match('GET', $path, $action);
    }

    public function match(string $method, $path, $action) {
        $this->routes[$method][] = new Route($path, $action);
        $this->run();
    }

    public function run() {
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matche($this->url)) {
                echo $route->execute();
            }
        }

        // return header("HTTP/1.0 404 Not Found");
    }
}
