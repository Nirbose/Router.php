<?php

use Nirbose\Router\Uri;
use PHPUnit\Framework\TestCase;

class UriTest extends TestCase {

    public function testUriNoParams() {
        Uri::setMethod('GET');
        Uri::setPath('/home');

        $this->assertTrue(Uri::is('GET', '/home'));
    }

    public function testUriWithParams() {
        Uri::setMethod('GET');
        Uri::setPath('/home/1');

        $this->assertTrue(Uri::is('GET', '/home/1'));
    }

}
