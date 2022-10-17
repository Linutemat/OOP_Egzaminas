<?php

declare(strict_types=1);

namespace Lina\ProductsReservation;

class Router
{
    private array $routes = [];

    public function add(string $requestMethod, string $requestPath, callable $action): void
    {
        $this->routes[$requestPath][$requestMethod] = $action;
    }

    public function route($requestMethod, $requestPath): void
    {
        if (!isset($this->routes[$requestPath])) {
            die('Unknown path');
        }
        $path = $this->routes[$requestPath];
        if (!isset($path[$requestMethod])) {
            die('Method for this path does not exist');
        }
        $action = $path[$requestMethod];
        $action();
    }
}