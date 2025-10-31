<?php

declare(strict_types = 1);

namespace App\Routing;

class Router {
    private array $routes = [];

    public static function add(string $path, string $method, $function): void {
        Router::$routes[$path] = [$method, $function];
    }
    public static function accept(string $path, string $method): void {
        foreach(Router::$routes as $key => $val) {
            if($path == $key && $val[0] == $method) {
                $val[1]();
                return;
            }
        }
        header("HTTP/1.1 404 Not Found");
    }
}