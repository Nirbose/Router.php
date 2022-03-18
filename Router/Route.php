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

    public function previous(): void
    {
        $previous = $_SERVER['HTTP_REFERER'] ?? '/';
        header("Location: $previous", true, 302);
        return;
    }

    public static function getRoutes(): array
    {
        return self::$routes;
    }

}
