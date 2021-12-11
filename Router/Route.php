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

        if (is_string($this->action)) {
            $params = explode('@', $this->action);
            $controller = new $params[0]();
            $method = $params[1];

            return call_user_func_array([$controller, $method], $this->matche);
        }

        if (is_array($this->action)) {
            $controller = new $this->action[0]();
            $method = $this->action[1];

            return call_user_func_array([$controller, $method], $this->matche);
        }

        throw new \Exception("L'action n'est pas valide");
    }
}
