<?php

declare(strict_types=1);

namespace Lina\ProductsReservation\Controller;

use Lina\ProductsReservation\Exception\InventoryException;

class AuthController extends Controller
{
    public function showReservation(): void
    {
        $this->render('./view/reservation.php');
    }

    public function handleReservation(): void
    {
        try {
            $inventoryData = json_decode(file_get_contents('./data/inventory.json'), true);
            $names = array_column($inventoryData, 'name');
            if (!in_array($_POST['name'], $names, true)) {
                throw new InventoryException('Product not available');
            }
            foreach ($inventoryData as $key => $inventoryItem) {
                if ($_POST['name'] === $inventoryItem['name'] && $inventoryItem['quantity'] >= $_POST['quantity']) {
                    $inventoryData[$key]['quantity'] = $inventoryItem['quantity'] - $_POST['quantity'];
                    file_put_contents('./data/inventory.json', json_encode($inventoryData, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT));
                    $reservationsData = json_decode(file_get_contents('./data/reservations.json'), true);
                    $newReservations = [
                        'email' => $_POST['email'],
                        'product_id' => $key,
                        'quantity' => $_POST['quantity']
                    ];
                    $reservationsData[] = $newReservations;
                    file_put_contents('./data/reservations.json', json_encode($reservationsData, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT));
                    echo 'Reservation successful';
                    return;
                }
            }
            if ($_POST['quantity'] > $inventoryItem['quantity']) {
                throw new InventoryException('Not enough items in stock');
            }
        } catch (InventoryException $exception) {
            echo $exception->getMessage();
        }
    }
}
