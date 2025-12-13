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
use App\Controllers\ThingController;
use App\Controllers\StoreController;

//new pages define
//for example
//Router::add('/', "GET", ClientController::index);
Router::add('/clientsAll', "GET", [ClientController::class. "index"]);
Router::add("/clientInfo", "GET", [ClientController::class, "show"]);
Router::add("/createClient", "POST", [ClientController::class, "create"]);
Router::add("/updateClient", "POST", [ClientController::class, "update"]);
Router::add("/deleteClient", "POST", [ClientController::class, "delete"]);

Router::add('/carsAll', "GET", [CarController::class, "index"]);
Router::add("/carInfo", "GET", [CarController::class, "show"]);
Router::add("/createCar", "POST", [CarController::class, "create"]);
Router::add("/updateCar", "POST", [CarController::class, "update"]);
Router::add("/deleteCar", "POST", [CarController::class, "delete"]);

Router::add('/documentsAll', "GET", [DocumentController::class, "index"]);
Router::add("/documentInfo", "GET", [DocumentController::class, "show"]);
Router::add("/createDocument", "POST", [DocumentController::class, "create"]);
Router::add("/updateDocument", "POST", [DocumentController::class, "update"]);
Router::add("/deleteDocument", "POST", [DocumentController::class, "delete"]);

Router::add('/liftsAll', "GET", [LiftController::class, "index"]);
Router::add("/liftInfo", "GET", [LiftController::class, "show"]);
Router::add("/createLift", "POST", [LiftController::class, "create"]);
Router::add("/updateLift", "POST", [LiftController::class, "update"]);
Router::add("/deleteLift", "POST", [LiftController::class, "delete"]);

//todo Commodities controllers and Store controller routes

Router::add('/thingsAll', "GET", [ThingController::class, "index"]);
Router::add("/thingInfo", "GET", [ThingController::class, "show"]);
Router::add("/createThing", "POST", [ThingController::class, "create"]);
Router::add("/updateThing", "POST", [ThingController::class, "update"]);
Router::add("/deleteThing", "POST", [ThingController::class, "delete"]);

//start router
Router::accept(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $_SERVER['REQUEST_METHOD']);
