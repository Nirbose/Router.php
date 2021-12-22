<?php

namespace Router;

class RouterFile {

    public static function add(string $xml_file)
    {
        $content = file_get_contents($xml_file);

        (new static())->parse($content);
    }

    private function parse(string $content)
    {
        $router = new Router();
        $xml = new \SimpleXMLElement($content);

        foreach ($xml->route as $route) {
            $method = "GET";

            if ($route->attributes()->method) {
                $method = strtoupper((string) $route->attributes()->method);
            }

            $path = (string) $route->attributes()->path;
            $action = (string) $route->attributes()->callable;

            $router->match($method, $path, $action);
        }

        $router->run();
    }

}
