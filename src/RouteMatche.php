<?php

namespace Nirbose\Router;

class RouteMatche {

    public const REGEX_FOR_ANY = "/\{([a-zA-Z0-9]+)\}/";

    public static function matches(string $method, string $uri, array $params = []): bool|array
    {
        if (strtoupper($method) != Url::getMethod()) {
            return 0;
        }

        if (trim(Url::getPath(), '/') == trim($uri, '/')) {
            return 1;
        }

        $pattern = preg_replace(RouteMatche::REGEX_FOR_ANY, '([^/]+)', $uri);

        if (preg_match_all("#^$pattern$#", Url::getPath(), $matches)) {
            return $matches;
        }

        return 0;
    }

}
