<?php

declare(strict_types=1);

use Lina\ProductsReservation\Router;
use Lina\ProductsReservation\Controller\AuthController;

require './vendor/autoload.php';

session_start();

$router = new Router();

$router->add('GET', '/reservation', function () {
    (new AuthController())->showReservation();
});
$router->add('POST', '/reservation', function () {
    (new AuthController())->handleReservation();
});
$router->add('GET', '/', function () {
    require './view/page.php';
});
$router->route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
