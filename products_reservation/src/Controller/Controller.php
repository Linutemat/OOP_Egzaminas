<?php

declare(strict_types=1);

namespace Lina\ProductsReservation\Controller;

class Controller
{
    public function render(string $inner, array $templateData = []): void
    {
        require './view/page.php';
    }
}
