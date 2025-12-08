<?php

declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Client;

class ClientController {
    public static function index(): TemplateEngine {
        $client = new Client();        
        $res = $client->getAll();

        return new TemplateEngine("clients_view.php", ["clients" => $res]);
    }
    public static function show(): TemplateEngine {
        $client = new Client();
        $clientId = $_GET["id"];
        $res = $client->get($clientId);
        return new TemplateEngine("clients_view.php", ["client" => $res]); 
    }
    public static function create(): TemplateEngine {
        $client = new Client();
        $clientName = $_POST["name"];
        $clientPhoneNumber = $_POST["phoneNumber"];
        $clientCity = $_POST["city"];
        $clientStreet = $_POST["street"];
        $clientBuildingName = $_POST["buildingName"];
        $clientNIP = $_POST["nip"];
        $clientEmail = $_POST["email"];
        $res = $client->create($clientName, $clientPhoneNumber, $clientCity, $clientStreet, $clientBuildingName, $clientNIP, $clientEmail);
        return new TemplateEngine("clients_description_view.php", ["status" => $res]);
    }
    public static function update(): TemplateEngine {
        $client = new Client();
        $clientId = $_POST["id"];
        $clientName = $_POST["name"];
        $clientPhoneNumber = $_POST["phoneNumber"];
        $clientCity = $_POST["city"];
        $clientStreet = $_POST["street"];
        $clientBuildingName = $_POST["buildingName"];
        $clientNIP = $_POST["nip"];
        $clientEmail = $_POST["email"];
        $res = $client->update($clientId, $clientName, $clientPhoneNumber, $clientCity, $clientStreet, $clientBuildingName, $clientNIP, $clientEmail);
        return new TemplateEngine("clients_view.php", ["status" => $res]);
    }
    public static function delete(): TemplateEngine {
        $client = new Client();
        $clientId = $_GET["id"];
        $res = $client->delete($clientId);
        return new TemplateEngine("clients_view.php", ["status" => $res]);
    }
}