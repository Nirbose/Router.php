<?php

use Nirbose\Router\Router;
use Nirbose\Router\Uri;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase {

    public function testHomeRoute() {

        Uri::setPath('/home');

        $response = Router::get('/home', function () { })->getRoute();

        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * Test route with params
     */
    public function testHomeRouteWithParams() {

        Uri::setPath('/home/1');
        Uri::setParams(['id' => 1]);

        $response = Router::get('/home/{id}', function (int $id) {
            $this->assertEquals(1, $id);
        })->getRoute();

        $this->assertEquals(200, $response->getStatusCode());
    
    }
}
