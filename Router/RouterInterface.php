<?php

namespace Router;

interface RouterInterface
{
    /**
     * add get route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function get(string $route, $callback);

    /**
     * add post route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function post(string $route, $callback);

    /**
     * add put route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function put(string $route, $callback);

    /**
     * add patch route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function patch(string $route, $callback);

    /**
     * add delete route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function delete(string $route, $callback);

    /**
     * add options route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function options(string $route, $callback);

    /**
     * add head route to router
     *
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public static function head(string $route, $callback);
}
