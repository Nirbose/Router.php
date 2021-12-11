<?php

namespace Router;

class Router {

    public $url;
    private $routes = [];

    public function __construct()
    {
        $this->url = trim($_SERVER['REQUEST_URI'], '/');
    }

    /**
     * Permet de créer une route GET
     *
     * @param string $path
     * @param callable|string $action
     * @return void
     */
    public function get(string $path, $action): void
    {
        $this->match('GET', $path, $action);
    }

    /**
     * Permet de créer une route POST
     *
     * @param string $path
     * @param callable|string $action
     * @return void
     */
    public function post(string $path, $action): void
    {
        $this->match('POST', $path, $action);
    }

    /**
     * Permet de créer une route PUT
     *
     * @param string $path
     * @param callable|string $action
     * @return void
     */
    public function put(string $path, $action): void
    {
        $this->match('PUT', $path, $action);
    }

    /**
     * Permet de créer une route PATCH
     *
     * @param string $path
     * @param callable|string $action
     * @return void
     */
    public function patch(string $path, $action): void
    {
        $this->match('PATCH', $path, $action);
    }

    /**
     * Permet de créer une route DELETE
     *
     * @param string $path
     * @param callable|string $action
     * @return void
     */
    public function delete(string $path, $action): void
    {
        $this->match('DEKETE', $path, $action);
    }

    /**
     * Permet de créer une route OPTIONS
     *
     * @param string $path
     * @param callable|string $action
     * @return void
     */
    public function options(string $path, $action): void
    {
        $this->match('OPTIONS', $path, $action);
    }

    /**
     * Permet de save les routes dans le tableau $routes
     * 
     * @param string $method
     * @param string $path
     * @param callable|string $action
     * @return void
     */
    public function match(string $method, $path, $action): void
    {
        $this->routes[$method][] = new Route($path, $action);
        // var_dump($this->routes);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Permet de lancer le router
     *
     * @return void
     */
    public function run() {
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matche($this->url)) {
                echo $route->execute();
                return;
            }
        }

        return header("HTTP/1.0 404 Not Found");
    }
}
