<?php

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class RouterTest extends TestCase {

    public function testRouteHome() {
        $request = new Client();
        $response = $request->get('http://localhost:5500/home');

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals("<h1>Hello World !</h1>", $response->getBody());
    }
}
