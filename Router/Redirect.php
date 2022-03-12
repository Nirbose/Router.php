<?php

namespace Router;

class Redirect {

    public function route(string $name, array $params = [], int $code = 302)
    {
        if (!isset(Route::getRoutes()[$name])) {
            throw new \Exception('Route not found');
        }

        $url = Route::getRoutes()[$name];

        foreach ($params as $key => $value) {
            $url = str_replace('{' . $key . '}', $value, $url);
        }

        header('Location: ' . $url, true, $code);
    }

}
