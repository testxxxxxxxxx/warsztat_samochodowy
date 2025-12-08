<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Car;
use App\Models\Client;

class CarController {

    public static function index(): TemplateEngine {
        $car = new Car();
        $client = new Client();
        $carsAndClients = $car->getAll();
        $clients = $client->getAll();

        return new TemplateEngine("cars_view.php", ["carsAndClients" => $carsAndClients, "clients" => $clients]);
    }
    public static function show(): TemplateEngine {
        $car = new Car();
        $id = $_GET["id"];
        $carsAndClients = $car->get($id);

        return new TemplateEngine("cars_description_view.php", ["carsAndClients" => $carsAndClients]);
    }
    public static function create(): TemplateEngine {
        $registrationNumber = $_POST["registrationNumber"];
        $mark = $_POST["mark"];
        $model = $_POST["model"];
        $engine = $_POST["engine"];
        $horsePower = $_POST["horsePower"];
        $power = $_POST["power"];
        $type = $_POST["type"]; 
        $year = $_POST["year"];
        $mileage = $_POST["mileage"];
        $clientId = $_POST["clientId"];
        $car = new Car();
        $status = $car->create($registrationNumber, $mark, $model, $engine, $horsePower, $power, $type, $year, $mileage, $clientId);
        return new TemplateEngine("cars_view.php", ["status" => $status]);
    }
    public static function update(): TemplateEngine {
        $id = $_POST["id"];
        $registrationNumber = $_POST["registrationNumber"];
        $mark = $_POST["mark"];
        $model = $_POST["model"];
        $engine = $_POST["engine"];
        $horsePower = $_POST["horsePower"];
        $power = $_POST["power"];
        $type = $_POST["type"]; 
        $year = $_POST["year"];
        $mileage = $_POST["mileage"];
        $clientId = $_POST["clientId"];
        $car = new Car();
        $status = $car->update($id, $registrationNumber, $mark, $model, $engine, $horsePower, $power, $type, $year, $mileage, $clientId);
        return new TemplateEngine("cars_view.php", ["status" => $status]);
    }
    public static function delete(): TemplateEngine {
        $id = $_POST["id"];
        $car = new Car();
        $status = $car->delete($id);
        return new TemplateEngine("cars_view.php", ["status" => $status]);
    }
}