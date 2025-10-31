<?php

declare(strict_types = 1);

namespace App\Routing;

class Router {
    private static array $routes = [];

    public static function add(string $path, string $method, callable $function): void {
        self::$routes[$path] = [$method, $function];
    }
    public static function accept(string $path, string $method): void {
        if(isset(self::$routes[$path]) && self::$routes[$path][0] == $method) {
            self::$routes[$path][1]();
            return;
        }
        header("HTTP/1.1 404 Not Found");
        echo "404 - Route not found!";
    }
}