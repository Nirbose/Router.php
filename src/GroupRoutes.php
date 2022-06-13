<?php

namespace Nirbose\Router;

class GroupRoutes
{

    private string $prefix;

    public function __construct(string $prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * 
     */
    public function group(callable $callback)
    {
        //
    }

}
