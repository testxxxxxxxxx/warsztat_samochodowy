<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Commodity;
use App\Models\ClientCommodity;
use App\Models\Client;

class CommodityController {
    public function index(): TemplateEngine {
        $commodity = new Commodity();
        $client = new Client();
        $commoditesAndClients = $commodity->getClientsAll();
        $clients = $client->getAll();

        return new TemplateEngine("commodity_view.php", ["commoditesAndClients" => $commoditesAndClients, "clients" => $client]);
    }
    public function show(): TemplateEngine {
        $code = $_GET["code"];
        $commodity = new Commodity();
        $commoditesAndClients = $commodity->getClients($code);
        
        return new TemplateEngine("commodity_desc_view.php", ["commoditesAndClients" => $commoditesAndClients]);
    }
    public function create(): TemplateEngine {
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
        $createStatus = $commodity->create($code, $name, $ean, $description, $bought, $tax) && $clientCommodity->create($clientId, $code);
        
        return new TemplateEngine("commodity_view.php", ["status" => $createStatus]);
    }
    public function update(): TemplateEngine {

    }
    public function delete(): TemplateEngine {

    }
}
