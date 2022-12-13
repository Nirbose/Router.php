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
     * Update route
     *
     * @param Route $old
     * @param Route $new
     * @return void
     */
     public static function update(Route $old, Route $new)
     {
        foreach (self::$routes as $key => $route) {
            if ($route['path'] == $old->getPath() && $route['method'] == $old->getMethod()) {
                self::$routes[$key] = $new->toArray();
            }
        }
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