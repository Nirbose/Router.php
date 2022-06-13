<?php

namespace Nirbose\Router;

class RouteCollector
{
    /**
     * @var array
     */
    private static array $routes = [];

    /**
     * add route
     *
     * @param Route $route
     * @return void
     */
    public static function add(Route $route)
    {
        array_push(self::$routes, $route->toArray());
    }

    /**
     * get routes
     *
     * @return array
     */
    public static function getRoutes(): array
    {
        return self::$routes;
    }

    /**
     * get route by method and path
     *
     * @param string $method
     * @param string $path
     * @return array
     */
    public static function getRoute(string $method, string $path): array
    {
        foreach (self::$routes as $route) {
            if ($route['method'] === $method && $route['path'] === $path) {
                return $route;
            }
        }

        return [];
    }

    /**
     * Get route by name 
     * 
     * @param string $name
     * @return array
     */
    public static function getRouteByName(string $name): array
    {
        foreach (self::$routes as $route) {
            if (array_key_exists('name', $route) && $route['name'] === $name) {
                return $route;
            }
        }

        return [];
    }

}
