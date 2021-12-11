<?php

namespace Router;

class Routes {

    public static ?Router $router = null;

    private static function init()
    {
        if (is_null(self::$router)) {
            return self::$router = new Router;
        }

        return self::$router;
    }

    public static function get(string $path, $action)
    {
        self::init()->get($path, $action);
    }

    public static function run() 
    {
        self::init()->run();
    }

}