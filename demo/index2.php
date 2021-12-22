<?php

use Router\RouterFile;

include '../vendor/autoload.php';

class Foo {
    public function bar() {
        return 'bar';
    }

    public function baz($page) {
        return 'baz ' . $page;
    }
}

RouterFile::add('./router.xml');