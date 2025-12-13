<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Commodity;
use App\Models\ClientCommodity;
use App\Models\Client;

class CommodityClientController {
    public static function index(): TemplateEngine {
        $commodity = new Commodity();
        $client = new Client();
        $commoditesAndClients = $commodity->getClientsAll();
        $clients = $client->getAll();

        return new TemplateEngine("commodity_view.php", ["commoditesAndClients" => $commoditesAndClients, "clients" => $client]);
    }
    public static function show(): TemplateEngine {
        $code = $_GET["code"];
        $commodity = new Commodity();
        $commoditesAndClients = $commodity->getClients($code);
        
        return new TemplateEngine("commodity_desc_view.php", ["commoditesAndClients" => $commoditesAndClients]);
    }
    public static function create(): TemplateEngine {
        $code = $_POST["code"];
        $name = $_POST["name"];
        $ean = $_POST["ean"];
        $description = $_POST["description"];
        $bought = $_POST["bought"];
        $sell = $_POST["sell"];
        $tax = $_POST["tax"];
        $clientId = $_POST["clientId"];
        $commodity = new Commodity();
        $clientCommodity = new ClientCommodity();
        $createStatus = $commodity->create($code, $name, $ean, $description, $bought, $sell, $tax) && $clientCommodity->create($clientId, $code);
        
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
        $newClientId = $_POST["newClientId"];
        $oldClientId = $_POST["oldClientId"];
        $commodity = new Commodity();
        $clientCommodity = new ClientCommodity();
        $updateStatus = $commodity->update($code, $name, $ean, $description, $bought, $sell, $tax) && $clientCommodity->delete($oldClientId, $code) && $clientCommodity->create($newClientId, $code);
        
        return new TemplateEngine("commodity_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $code = $_POST["code"];
        $commodity = new Commodity();
        $clientCommodity = new ClientCommodity();
        $deleteStatus = $commodity->delete($code);

        return new TemplateEngine("commodity_view.php", ["status" => $deleteStatus]);
    }
}
