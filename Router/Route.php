<?php

namespace Router;

class Route {

    public $path;
    public $action;
    public $matche = [];

    public function __construct($path, $action)
    {
        $this->path = trim($path, '/');
        $this->action = $action;
    }

    public function matche($url) {
        $path = preg_replace('#{([\w])+}#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";

        if (preg_match_all($pathToMatch, $url, $matche)) {
            foreach($matche as $key => $value) {
                if ($key != 0) {
                    array_push($this->matche, $value[0]);
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function execute() {
        if (is_callable($this->action)) {
            return call_user_func_array($this->action, $this->matche);
        }

        $params = explode('@', $this->action);
        $controller = new $params[0]();
        $method = $params[1];

        return call_user_func_array([$controller, $method], $this->matche);
        // isset($this->matche[1]) ? $controller->$method($this->matche[1]) : $controller->$method();
    }
}
