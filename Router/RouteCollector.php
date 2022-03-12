<?php

namespace Router;

class RouteCollector {

    private string $base;

    public function __construct(string $base)
    {
        $this->base = trim($base, '/') . '/';
    }

    /**
     * add get route to collector
     * 
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public function get(string $route, $callback): Route
    {
        return Router::get($this->base . trim($route, '/'), $callback);
    }

    /**
     * add post route to collector
     * 
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public function post(string $route, $callback): Route
    {
        return Router::post('POST', $this->base . $route, $callback);
    }

    /**
     * add put route to collector
     * 
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public function put(string $route, $callback): Route
    {
        return Router::put('PUT', $this->base . $route, $callback);
    }

    /**
     * add patch route to collector
     * 
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public function patch(string $route, $callback): Route
    {
        return Router::patch('PATCH', $this->base . $route, $callback);
    }

    /**
     * add delete route to collector
     * 
     * @param string $route
     * @param string|array|callback $callback
     * @return Route
     */
    public function delete(string $route, $callback): Route
    {
        return Router::delete('DELETE', $this->base . $route, $callback);
    }

}
