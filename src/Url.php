<?php

namespace Nirbose\Router;

class Url {

    private static string $method = 'GET';

    private static string $path = '/';

    /**
     * params of route
     *
     * @var array
     */
    private static array $params = [];

    /**
     * Headers of route
     * 
     * @var array
     */
    private static array $headers = [];

    /**
     * set method
     *
     * @param string $method
     * @return void
     */
    public static function setMethod(string $method): void
    {
        self::$method = strtoupper($method);
    }

    /**
     * set path
     *
     * @param string $path
     * @return void
     */
    public static function setPath(string $path): void
    {
        self::$path = $path;
    }

    /**
     * set params
     *
     * @param array $params
     * @return void
     */
    public static function setParams(array $params): void
    {
        self::$params = $params;
    }

    /**
     * set headers
     *
     * @param array $headers
     * @return void
     */
    public static function setHeaders(array $headers): void
    {
        self::$headers = $headers;
    }

    /**
     * get method
     *
     * @return string
     */
    public static function getMethod(): string
    {
        return isset($_SERVER['REQUEST_METHOD']) ? strtoupper($_SERVER['REQUEST_METHOD']) : strtoupper(self::$method);
    }

    /**
     * get path
     *
     * @return string
     */
    public static function getPath(): string
    {
        return $_SERVER['REQUEST_URI'] ?? self::$path;
    }

    /**
     * get params
     *
     * @return array
     */
    public static function getParams(): array
    {
        return self::$params;
    }

    /**
     * Get all url
     * 
     * @return string
     */
    public static function getUrl(): string
    {
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }

        if (!isset($_SERVER['HTTP_HOST'])) {
            $host = "localhost/";
        } else {
            $host = $_SERVER['HTTP_HOST'];
        }
        
        return $protocol . $host . self::getPath();
    }

    /**
     * get headers
     *
     * @return array
     */
    public static function getHeaders(): array
    {
        return self::$headers;
    }

    /**
     * Match the path with the route
     * 
     * @param string $method
     * @param string $path
     * @return bool
     */
    public static function is(string $method, string $route): bool
    {
        if (strtoupper($method) ==! static::getMethod()) {
            return false;
        }

        if ($route === static::getPath()) {
            return true;
        }

        if (!preg_match_all("#{([\w]+)}#", $route, $matches)) {
            return false;
        }

        return true;
    }

    /**
     * trim uri to match route
     * 
     * @param string $route
     * @return string
     */
    public static function trim(string $route): string
    {
        return trim($route, '/');
    }

}
