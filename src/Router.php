<?php

namespace Nirbose\Router;

class Router {

    /**
     * Get route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function get(string $path, string|callable|array $action): Route
    {
        return static::route('GET', $path, $action);
    }

    /**
     * Post route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function post(string $path, string|callable|array $action): Route
    {
        return static::route('POST', $path, $action);
    }

    /**
     * Put route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function put(string $path, string|callable|array $action): Route
    {
        return static::route('PUT', $path, $action);
    }

    /**
     * Delete route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function delete(string $path, string|callable|array $action): Route
    {
        return static::route('DELETE', $path, $action);
    }

    /**
     * Patch route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function patch(string $path, string|callable|array $action): Route
    {
        return static::route('PATCH', $path, $action);
    }

    /**
     * Options route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function options(string $path, string|callable|array $action): Route
    {
        return static::route('OPTIONS', $path, $action);
    }

    /**
     * Head route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function head(string $path, string|callable|array $action): Route
    {
        return static::route('HEAD', $path, $action);
    }

    /**
     * Any route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function any(string $path, string|callable|array $action): Route
    {
        return static::route(['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'HEAD', 'OPTIONS'], $path, $action);
    }

    /**
     * Route
     * 
     * @param string|array $method
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function route(string|array $method, string $path, string|callable|array $action): Route
    {
        if (is_array($method)) {
            foreach ($method as $m) {
                $match = RouteMatche::matches($m, $path);
            }
        } else {
            $match = RouteMatche::matches($method, $path);
        }

        if (is_array($match)) {
            call_user_func_array($action, $match[1]);
        }

        if ($match) {
            $action();
        }

        return new Route($method, $path, $action);
    }

    /**
     * Grouping routes
     * 
     * @param string $prefix
     * @param Route[] $routes
     * @return Route[]
     */
    public static function group(string $path, array $routes): array
    {
        $allRoutes = [];

        /** @var Route $route */
        foreach ($routes as $route) {
            $route->setPath(
                '/' . Url::trim($path) . '/' . Url::trim($route->getPath())
            );
            Router::route($route->getMethod(), $route->getPath(), $route->getAction());

            array_push($allRoutes, $route);
        }

        return $allRoutes;
    }

    /**
     * @param Route[] $routes
     * @param callable $middleware
     */
    public static function middleware(array $routes, callable $middleware)
    {
        foreach ($routes as $route) {
            $newRoute = $route;
            $newRoute->setMiddleware($middleware);
            RouteCollector::update($route, $newRoute);
        }
    }

}
