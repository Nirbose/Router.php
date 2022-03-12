<?php

namespace Router;

class Route {

    private string $route;

    private static array $routes = [];

    public function __construct(string $route)
    {
        $this->route = $route;
    }

    public function name(string $name): self
    {
        self::$routes[$name] = $this->route;
        return $this;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

}
