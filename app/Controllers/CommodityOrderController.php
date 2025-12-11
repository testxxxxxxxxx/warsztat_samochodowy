<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Commodity;
use App\Models\CommodityOrder;
use App\Models\Order;

class CommodityOrderController {
    public function index(): TemplateEngine {
        $commodity = new Commodity();
        $client = new Client();
        $commoditesAndOrders = $commodity->getOrdersAll();
        $orders = $order->getAll();

        return new TemplateEngine("commodity_view.php", ["commoditesAndOrders" => $commoditesAndOrders, "orders" => $orders]);
    }
    public function show(): TemplateEngine {
        $code = $_GET["code"];
        $commodity = new Commodity();
        $commoditesAndOrders = $commodity->getOrders($code);
        
        return new TemplateEngine("commodity_desc_view.php", ["commoditesAndOrders" => $commoditesAndOrders]);
    }
    public function create(): TemplateEngine {
        $code = $_POST["code"];
        $name = $_POST["name"];
        $ean = $_POST["ean"];
        $description = $_POST["description"];
        $bought = $_POST["bought"];
        $sell = $_POST["sell"];
        $tax = $_POST["tax"];
        $jobId = $_POST["jobId"];
        $commodity = new Commodity();
        $commodityOrder = new CommodityOrder();
        $createStatus = $commodity->create($code, $name, $ean, $description, $bought, $sell, $tax) && $commodityOrder->create($code, $jobId);
        
        return new TemplateEngine("commodity_view.php", ["status" => $createStatus]);
    }
    public function update(): TemplateEngine {
        $code = $_POST["code"];
        $name = $_POST["name"];
        $ean = $_POST["ean"];
        $description = $_POST["description"];
        $bought = $_POST["bought"];
        $sell = $_POST["sell"];
        $tax = $_POST["tax"];
        $newJobId = $_POST["newJobId"];
        $oldJobId = $_POST["oldJobId"];
        $commodity = new Commodity();
        $clientCommodity = new ClientCommodity();
        $updateStatus = $commodity->update($code, $name, $ean, $description, $bought, $sell, $tax) && $clientCommodity->delete($oldJobId, $code) && $clientCommodity->create($newJobId, $code);
        
        return new TemplateEngine("commodity_view.php", ["status" => $updateStatus]);
    }
    public function delete(): TemplateEngine {
        $code = $_POST["code"];
        $commodity = new Commodity();
        $clientCommodity = new ClientCommodity();
        $deleteStatus = $commodity->delete($code);

        return new TemplateEngine("commodity_view.php", ["status" => $deleteStatus]);
    }
}