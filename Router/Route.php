<?php

namespace Router;

class Route {

    public static $url;
    private static $routes = [];
    private static $names = [];

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
     * Redirect to route
     *
     * @param string $name
     * 
     * @return void
     */
    public static function redirect(string $name): void
    {
        if (isset(self::$names[$name])) {
            $url = self::$names[$name]->path;
            header("Location: /" . $url);
        }
    }

    /**
     * Get route
     * 
     * @param string $route
     * @param callable|string $action
     * 
     * @return self
     */
    public static function get(string $path, $action): self
    {
        return self::match('GET', $path, $action);
    }

    /**
     * Post route
     * 
     * @param string $route
     * @param callable|string $action
     * 
     * @return self
     */
    public static function post(string $path, $action): self
    {
        return self::match('POST', $path, $action);
    }

    /**
     * Put route
     * 
     * @param string $route
     * @param callable|string $action
     * 
     * @return self
     */
    public static function put(string $path, $action): self
    {
        return self::match('PUT', $path, $action);
    }

    /**
     * Delete route
     * 
     * @param string $route
     * @param callable|string $action
     * 
     * @return self
     */
    public static function delete(string $path, $action): self
    {
        return self::match('DELETE', $path, $action);
    }

    /**
     * Patch route
     * 
     * @param string $route
     * @param callable|string $action
     * 
     * @return self
     */
    public static function patch(string $path, $action): self
    {
        return self::match('PATCH', $path, $action);
    }

    /**
     * Options route
     * 
     * @param string $route
     * @param callable|string $action
     * 
     * @return self
     */
    public static function options(string $path, $action): self
    {
        return self::match('OPTIONS', $path, $action);
    }

    /**
     * Permet de save les routes dans le tableau $routes
     * 
     * @param string $method
     * @param string $path
     * @param callable|string|array $action
     * 
     * @return self
     */
    public static function match(string $method, string $path, $action): self
    {
        self::$routes[$method][] = new Router($path, $action);
        return new static();
    }

    /**
     * Permet de lancer le router
     *
     * @return void
     */
    public static function run(): void
    {
        self::$url = trim($_SERVER['REQUEST_URI'], '/');

        /**
         * @var Router $route
         */
        foreach(self::$routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matche(self::$url)) {
                echo $route->execute();
                return;
            }
        }

        // return header("HTTP/1.0 404 Not Found");
    }

    /**
     * Route Name
     *
     * @param string $name
     * 
     * @return self
     */
    public function name(string $name): self
    {
        $this::$names[$name] = end($this::$routes[$_SERVER['REQUEST_METHOD']]);
        return $this;
    }

}
