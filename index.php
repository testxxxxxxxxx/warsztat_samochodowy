<?php
declare(strict_types = 1);
require __DIR__."/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

use App\Routing\Router;
use App\Controllers\MainController;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//start router
Router::accept($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

//new pages define
//for example
//Router::add('/', "GET", MainController::index);