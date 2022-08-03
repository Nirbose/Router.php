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
        $this->setPath($path);
        $this->action = $action;

        RouteCollector::add($this);
    }

    public function name(string $name)
    {
        $this->name = $name;
        return $this;
    }

    public function setPath(string $path)
    {
        $this->path = $path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function toArray()
    {
        $route = [
            'method'    => $this->method,
            'path'      => $this->path,
            'action'    => $this->action,
            'name'      => is_null($this->name) ? null : $this->name,
        ];

        return $route;
    }

}
