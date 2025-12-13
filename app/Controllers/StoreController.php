<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Store;

class StoreController {
    public static function index(): TemplateEngine {
        $store = new Store();
        $storesClientsThing = $store->getAll();
        return new TemplateEngine("store_view.php", ["storesClientsThing" => $storesClientsThing]); 
    }
    public static function show(): TemplateEngine {
        $id = $_GET["id"];
        $store = new Store();
        $storesClientsThing = $store->get($id);

        return new TemplateEngine("store_desc_view.php", ["storesClientsThing" => $storesClientsThing]);
    }
    public static function create(): TemplateEngine {
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $thingId = $_POST["thingId"];
        $clientId = $_POST["clientId"];
        $store = new Store();
        $createStatus = $store->create($startDate, $endDate, $thingId, $clientId);
        
        return new TemplateEngine("store_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $id = $_POST["id"];
        $startDate = $_POST["startDate"];
        $endDate = $_POST["endDate"];
        $thingId = $_POST["thingId"];
        $clientId = $_POST["clientId"];
        $store = new Store();
        $updateStatus = $store->update($id, $startDate, $endDate, $thingId, $clientId);
        
        return new TemplateEngine("store_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $id = $_POST["id"];
        $store = new Store();
        $deleteStatus = $store->delete($id);

        return new TemplateEngine("store_view.php", ["status" => $deleteStatus]);
    }
}