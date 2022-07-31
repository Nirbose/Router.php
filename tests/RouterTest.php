<?php

use GuzzleHttp\Psr7\Request;
use Nirbose\Router\Router;
use Nirbose\Router\Url;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase {

    public function testRouteMethod()
    {
        $request = new Request('GET', '/home');
        $route = Router::get('/home', function () {});

        $this->assertEquals($request->getMethod(), $route->getMethod());
    }

    public function testGroupRoute()
    {
        $request = new Request('GET', '/home/foo');

        $routes = Router::group('/home', [
            Router::get('/foo', function () {}),
            Router::get('/bar', function () {}),
        ]);

        $this->assertEquals($request->getUri()->getPath(), $routes[0]->getPath());
    }
    
}
