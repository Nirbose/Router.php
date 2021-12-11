<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Router\Routes;

class RouterTest extends TestCase {

    public function testRouteHome() {

        // test
        $request = new Client();
        $response = $request->get('http://localhost:5500/about');

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testNoExistRoute() {

        // test
        $request = new Client();
        $response = $request->get('http://localhost:5500/no-exist');

        $this->assertEquals('404 Not Found', $response->getStatusCode());
    }
}
