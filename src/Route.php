<?php

namespace Nirbose\Router;

use GuzzleHttp\Psr7\Response;

class Route {

    /**
     * @var string
     */
    private string $method;

    /**
     * @var string
     */
    private string $path;

    /**
     * @var callable|string|array
     */
    private $action;

    /**
     * @var string|null
     */
    private $name = null;

    public function __construct(string $method, string $path, $action)
    {
        $this->method = $method;
        $this->path = $path;
        $this->action = $action;

        RouteCollector::add($this);
    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function toArray()
    {
        $route = [
            'method' => $this->method,
            'path' => $this->path,
            'action' => $this->action,
        ];

        if ($this->name !== null) $route['name'] = $this->name;

        return $route;
    }

}
