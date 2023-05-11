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
    private ?string $name = null;

    /**
     * @var callable|null
     */
     private $middleware = null;

    public function __construct(string $method, string $path, $action)
    {
        $this->method = $method;
        $this->setPath($path);
        $this->action = $action;

        RouteCollector::add($this);
    }

    public function name(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function setMiddleware(callable $middleware): void
    {
        $this->middleware = $middleware;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getAction(): callable|array|string
    {
        return $this->action;
    }

    public function getMiddleware(): ?callable
    {
        return $this->middleware;
    }

    public function toArray(): array
    {
        return [
            'method'        => $this->method,
            'path'          => $this->path,
            'action'        => $this->action,
            'name'          => $this->name,
            'middleware'    => $this->middleware,
        ];
    }

}
