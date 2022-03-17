<?php

namespace Router;

class Router implements RouterInterface {

    const METHODS_ALL = ['get', 'post', 'put', 'patch', 'delete'];

    /**
     * Create group routes for all methods
     * 
     * @param string $route
     * @param callable $callback
     * @return void
     */
    public static function group(string $base, callable $callback)
    {
        $routes = RouteCollector::new($base);
        $callback($routes);
    }

    /**
     * add get route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function get(string $route, $callback): Route
    {
        self::match('GET', $route, $callback);
        return new Route($route);
    }

    /**
     * add post route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function post(string $route, $callback): Route
    {
        self::match('POST', $route, $callback);
        return new Route($route);
    }

    /**
     * add put route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function put(string $route, $callback): Route
    {
        self::match('PUT', $route, $callback);
        return new Route($route);
    }

    /**
     * add patch route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function patch(string $route, $callback): Route
    {
        self::match('PATCH', $route, $callback);
        return new Route($route);
    }

    /**
     * add delete route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function delete(string $route, $callback): Route
    {
        self::match('DELETE', $route, $callback);
        return new Route($route);
    }

    /**
     * add options route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function options(string $route, $callback): Route
    {
        self::match('OPTIONS', $route, $callback);
        return new Route($route);
    }

    /**
     * add head route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function head(string $route, $callback): Route
    {
        self::match('HEAD', $route, $callback);
        return new Route($route);
    }

    /**
     * match method
     *
     * @param string|array $method
     * @param string $route
     * @param string|array|callback $callback
     * @return void
     */
    public static function match($method, string $route, $callback)
    {
        $route = trim($route, '/');
        $matches = [];

        if (is_array($method)) {
            foreach ($method as $m) {
                self::match($m, $route, $callback);
            }
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === strtoupper($method)) {
            $path = preg_replace('#{([\w])+}#', '([^/]+)', $route);
            $pathToMatch = "#^$path$#";

            if (preg_match_all($pathToMatch, trim($_SERVER['REQUEST_URI'], '/'), $matche)) {

                http_response_code(200);
                
                foreach($matche as $key => $value) {
                    if ($key != 0) {
                        array_push($matches, $value[0]);
                    }
                }

                if (is_callable($callback)) {
                    return call_user_func_array($callback, $matches);
                }

                if (is_string($callback)) {
                    $callback = explode('@', $callback);
                }

                if (!class_exists($callback[0])) {
                    throw new \Exception("Class {$callback[0]} not found");
                }

                $class = new $callback[0];

                if (!method_exists($class, $callback[1])) {
                    throw new \Exception("Method $callback[1] not found in class $callback[0]");
                }

                echo $class->{$callback[1]}($matches);
                return;
            }

            // 404 page
            header('HTTP/1.0 404 Not Found', true, 404);
        }
    }

}
