<?php

namespace Nirbose\Router;

use GuzzleHttp\Psr7\Response;

class Router {

    protected static $routes = [];
    
    /**
     * Route of method GET
     * 
     * @param string $path
     * @param array|callable|string $callback
     * @return Route|Response
     */
    public static function get(string $path, array|callable|string $callback): Route|Response
    {
        return static::addRoute('GET', $path, $callback);
    }

    /**
     * Add route to routes array
     *
     * @param string $method
     * @param string $route
     * @param array|callable|string $callback
     * @return Route|Response
     */
    public static function addRoute(string $method, string $route, array|callable|string $callback): Route|Response
    {
        static::$routes[$method][$route] = $callback;

        return static::match($method, $route, $callback);
    }

    public static function match(string $method, string $path, array|callable|string $callback)
    {
        if (!Uri::is($method, $path)) {
            return new Response(404);
        }

        // if (is_callable($callback)) {
        //     call_user_func_array($callback, Uri::getParams());
        //     return new Route($method, $path);
        // }

        // if (is_string($callback)) {
        //     $callback = explode('@', $callback);
        // }

        // $class = $callback[0];
        // $func = $callback[1];

        // (new $class)->$func(...Uri::getParams());

        return new Route($method, $path);
    }

}
