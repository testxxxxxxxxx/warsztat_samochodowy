<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Commodity;

class CommodityController {
    public static function index(): TemplateEngine {
        $commodity = new Commodity();
        $commodites = $commodity->getAll();
        $clients = $commodity->getClientsAll();
        $orders = $commodity->getOrdersAll();

        return new TemplateEngine("commodity_view.php", ["commodites" => $commodites, "clients" => $clients, "orders" => $orders]);
    }
    public static function show(): TemplateEngine {
        $code = $_GET["code"];
        $commodity = new Commodity();
        $clients = $commodity->getClients($code);
        $orders = $commodity->getOrders($code);

        return new TemplateEngine("commodity_desc_view.php", ["clients" => $clients, "orders" => $orders]);
    }
    public static function create(): TemplateEngine {
        $code = $_POST["code"];
        $name = $_POST["name"];
        $ean = $_POST["ean"];
        $description = $_POST["description"];
        $bought = $_POST["bought"];
        $sell = $_POST["sell"];
        $tax = $_POST["tax"];
        $commodity = new Commodity();
        $createStatus = $commodity->create($code, $name, $ean, $description, $bought, $sell, $tax);
        
        return new TemplateEngine("commodity_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $code = $_POST["code"];
        $name = $_POST["name"];
        $ean = $_POST["ean"];
        $description = $_POST["description"];
        $bought = $_POST["bought"];
        $sell = $_POST["sell"];
        $tax = $_POST["tax"];
        $commodity = new Commodity();
        $updateStatus = $commodity->update($code, $name, $ean, $description, $bought, $sell, $tax);
        
        return new TemplateEngine("commodity_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $code = $_POST["code"];
        $commodity = new Commodity();
        $deleteStatus = $commodity->delete($code);

        return new TemplateEngine("commodity_view.php", ["status" => $deleteStatus]);
    }
}