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
     * Get routes
     *
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * Permet de créer une route GET
     *
     * @param string $path
     * @param callable|string|array $action
     * @return void
     */
    public function get(string $path, $action)
    {
        return $this->match('GET', $path, $action);
    }

    /**
     * Permet de créer une route POST
     *
     * @param string $path
     * @param callable|string|array $action
     * @return void
     */
    public function post(string $path, $action)
    {
        return $this->match('POST', $path, $action);
    }

    /**
     * Permet de créer une route PUT
     *
     * @param string $path
     * @param callable|string|array $action
     * @return void
     */
    public function put(string $path, $action)
    {
        return $this->match('PUT', $path, $action);
    }

    /**
     * Permet de créer une route PATCH
     *
     * @param string $path
     * @param callable|string|array $action
     * @return void
     */
    public function patch(string $path, $action)
    {
        return $this->match('PATCH', $path, $action);
    }

    /**
     * Permet de créer une route DELETE
     *
     * @param string $path
     * @param callable|string|array $action
     * @return void
     */
    public function delete(string $path, $action)
    {
        return $this->match('DEKETE', $path, $action);
    }

    /**
     * Permet de créer une route OPTIONS
     *
     * @param string $path
     * @param callable|string|array $action
     * @return void
     */
    public function options(string $path, $action)
    {
        return $this->match('OPTIONS', $path, $action);
    }

    /**
     * Permet de save les routes dans le tableau $routes
     * 
     * @param string $method
     * @param string $path
     * @param callable|string|array $action
     * @return void
     */
    public function match(string $method, string $path, $action): self
    {
        $this->routes[$method][] = new Route($path, $action);
        return $this;
    }

    /**
     * Permet de lancer une fonction qui demande le POST 
     * 
     * @param callable|string|array $fn
     * 
     * @return self
     */
    public function valid($fn): self
    {
        if (is_callable($fn)) {
            call_user_func_array($fn, $_POST);
        }

        if (is_string($fn)) {
            if (strpos($fn, '@') !== false) {
                $fn = explode('@', $fn);
                $controller = new $fn[0]();
                $method = $fn[1];
                call_user_func_array([$controller, $method], $_POST);
            }
        }

        if (is_array($fn)) {
            call_user_func_array([new $fn[0](), $fn[1]], $_POST);
        }

        return $this;
    }

    /**
     * Permet de lancer le router
     *
     * @return void
     */
    public function run()
    {
        foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matche($this->url)) {
                echo $route->execute();
                return;
            }
        }

        // return header("HTTP/1.0 404 Not Found");
    }
}
