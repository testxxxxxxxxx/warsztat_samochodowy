<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\OrderWorkerWorkshop;

class OrderWorkerWorkshopController {
    
    public static function index(): TemplateEngine {

    }
    public static function show(): TemplateEngine {

    }
    public static function create(): TemplateEngine {
        $orderWorkerWorkshop = new OrderWorkerWorkshop();
        $workerId = $_POST["workerId"];
        $orderId = $_POST["orderId"];
        $createStatus = $orderWorkerWorkshop->create($workerId, $orderId);

        return new TemplateEngine("order_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {

    } 
    public static function delete(): TemplateEngine {
        $orderWorkerWorkshop = new OrderWorkerWorkshop();
        $workerId = $_POST["workerId"];
        $orderId = $_POST["orderId"];
        $deleteStatus = $orderWorkerWorkshop->delete($workerId, $orderId);

        return new TemplateEngine("order_view.php", ["status" => $createStatus]);
    }
}