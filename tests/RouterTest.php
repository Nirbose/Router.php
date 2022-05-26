<?php

use Nirbose\Router\Router;
use Nirbose\Router\Uri;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase {

    public function testHomeRoute() {

        Uri::setPath('/home');

        $response = Router::get('/home', [
            'controller' => HomeController::class,
            'action' => 'index'
        ])->getRoute();

        $this->assertEquals(200, $response->getStatusCode());
    }

}
