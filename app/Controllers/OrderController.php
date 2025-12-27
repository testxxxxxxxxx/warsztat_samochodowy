<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Order;

class OrderController {
    public static function index(): TemplateEngine {
        $order = new Order();
        $orders = $order->getAll();
        $cars = $order->getCarAll();
        $workers = $order->getWorkerAll();

        return new TemplateEngine("order_view.php", ["orders" => $orders, "cars" => $cars, "workers" => $workers]);
    }
    public static function show(): TemplateEngine {
        $id = $_GET["id"];
        $order = new Order();
        $car = $order->getCar($id);
        $worker = $order->getWorker($id);

        return new TemplateEngine("order_desc_view.php", ["car" => $car, "worker" => $worker]);
    }
    public static function create(): TemplateEngine {
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $description = $_POST["description"];
        $createdDate = $_POST["createdDate"];
        $state = $_POST["state"];
        $carId = $_POST["carId"];
        $workerId = $_POST["workerId"];
        $order = new Order();
        $createStatus = $order->create($startDate, $endDate, $description, $createdDate, $state, $carId, $workerId);

        return new TemplateEngine("order_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $id = $_POST["id"];
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $description = $_POST["description"];
        $createdDate = $_POST["createdDate"];
        $state = $_POST["state"];
        $carId = $_POST["carId"];
        $workerId = $_POST["workerId"];
        $order = new Order();
        $updateStatus = $order->update($id, $startDate, $endDate, $description, $createdDate, $state, $carId, $workerId);

        return new TemplateEngine("order_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $id = $_POST["id"];
        $order = new Order();
        $deleteStatus = $order->delete($id);

        return new TemplateEngine("order_view.php", ["status" => $deleteStatus]);
    }
}