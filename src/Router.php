<?php

namespace Nirbose\Router;

use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class Router {

    /**
     * Get route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function get(string $path, $action): Route
    {
        return new Route('GET', $path, $action);
    }

    /**
     * Post route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function post(string $path, $action): Route
    {
        return new Route('POST', $path, $action);
    }

    /**
     * Put route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function put(string $path, $action): Route
    {
        return new Route('PUT', $path, $action);
    }

    /**
     * Delete route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function delete(string $path, $action): Route
    {
        return new Route('DELETE', $path, $action);
    }

    /**
     * Patch route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function patch(string $path, $action): Route
    {
        return new Route('PATCH', $path, $action);
    }

    /**
     * Options route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function options(string $path, $action): Route
    {
        return new Route('OPTIONS', $path, $action);
    }

    /**
     * Head route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function head(string $path, $action): Route
    {
        return new Route('HEAD', $path, $action);
    }

    /**
     * Any route
     * 
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function any(string $path, $action): Route
    {
        return new Route('*', $path, $action);
    }

    /**
     * Route
     * 
     * @param string $method
     * @param string $path
     * @param string|callable|array $action
     * @return Route
     */
    public static function route(string $method, string $path, $action): Route
    {
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

            array_push($allRoutes, $route);
        }

        return $allRoutes;
    }

}
