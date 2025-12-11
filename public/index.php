<?php
declare(strict_types = 1);
require __DIR__."/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Routing\Router;
use App\Controllers\ClientController;
use App\Controllers\CarController;
use App\Controllers\DocumentController;
use App\Controllers\LiftController;
use App\Controllers\CommodityClientController;
use App\Controllers\CommodityOrderController;

//new pages define
//for example
//Router::add('/', "GET", ClientController::index);
Router::add('/clientsAll', "GET", ClientController::index);
Router::add("/clientInfo", "GET", ClientController::show);
Router::add("/createClient", "POST", ClientController::create);
Router::add("/updateClient", "POST", ClientController::update);
Router::add("/deleteClient", "POST", ClientController::delete);

Router::add('/carsAll', "GET", CarController::index);
Router::add("/carInfo", "GET", CarController::show);
Router::add("/createCar", "POST", CarController::create);
Router::add("/updateCar", "POST", CarController::update);
Router::add("/deleteCar", "POST", CarController::delete);

Router::add('/documentsAll', "GET", DocumentController::index);
Router::add("/documentInfo", "GET", DocumentController::show);
Router::add("/createDocument", "POST", DocumentController::create);
Router::add("/updateDocument", "POST", DocumentController::update);
Router::add("/deleteDocument", "POST", DocumentController::delete);

Router::add('/liftsAll', "GET", LiftController::index);
Router::add("/liftInfo", "GET", LiftController::show);
Router::add("/createLift", "POST", LiftController::create);
Router::add("/updateLift", "POST", LiftController::update);
Router::add("/deleteLift", "POST", LiftController::delete);

//start router
Router::accept(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $_SERVER['REQUEST_METHOD']);
