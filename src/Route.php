<?php

namespace Nirbose\Router;

use GuzzleHttp\Psr7\Response;

class Route extends Router {

    private array $route;

    public function __construct(string $method, string $path)
    {
        $this->route = [
            'method' => $method,
            'path' => $path
        ];
    }

    public function setHeaders(array $headers)
    {
        $this->route['headers'] = $headers;
    }

    public function name(string $name)
    {
        $this->route['name'] = $name;
    }

    public function getRoute(): Response
    {
        $headers = $this->route['headers'] ?? [];

        return new Response(200, $headers);
    }

}
