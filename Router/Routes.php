<?php

namespace Router;

class Routes {

    /**
     * Router
     *
     * @var Router|null
     */
    protected static $router = null;

    /**
     * Initialize the router
     * 
     * @param Router $router
     */
    private static function init()
    {
        if (is_null(self::$router)) {
            return self::$router = new Router;
        }

        return self::$router;
    }

    /**
     * Get route
     * 
     * @param string $route
     * @param callable|string $action
     */
    public static function get(string $path, $action)
    {
        return self::init()->get($path, $action);
    }

    /**
     * Post route
     * 
     * @param string $route
     * @param callable|string $action
     */
    public static function post(string $path, $action)
    {
        return self::init()->post($path, $action);
    }

    /**
     * Put route
     * 
     * @param string $route
     * @param callable|string $action
     */
    public static function put(string $path, $action)
    {
        return self::init()->put($path, $action);
    }

    /**
     * Delete route
     * 
     * @param string $route
     * @param callable|string $action
     */
    public static function delete(string $path, $action)
    {
        return self::init()->delete($path, $action);
    }

    /**
     * Patch route
     * 
     * @param string $route
     * @param callable|string $action
     */
    public static function patch(string $path, $action)
    {
        return self::init()->patch($path, $action);
    }

    /**
     * Options route
     * 
     * @param string $route
     * @param callable|string $action
     */
    public static function options(string $path, $action)
    {
        return self::init()->options($path, $action);
    }

    /**
     * Run the router
     *
     * @return void
     */
    public static function run() 
    {
        self::init()->run();
    }

}