<?php
declare(strict_types = 1);
require __DIR__."/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Routing\Router;
use App\Controllers\ClientController;

//new pages define
//for example
//Router::add('/', "GET", ClientController::index);
Router::add('/clientsAll', "GET", ClientController::index);
Router::add("/client", "GET", ClientController::show);
Router::add("/createClient", "POST", ClientController::create);
Router::add("/updateClient", "POST", ClientController::update);
Router::add("/deleteClient", "POST", ClientController::delete);

//start router
Router::accept(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), $_SERVER['REQUEST_METHOD']);
