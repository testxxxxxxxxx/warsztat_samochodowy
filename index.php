<?php
declare(strict_types = 1);

namespace App;

require __DIR__."/vendor/autoload.php";

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__."/Routing/Router.php";
require_once __DIR__."/Controllers/MainController.php";

use App\Routing\Router;
use App\Controllers\MainController;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//start router
Router::accept($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

//new pages define
//for example
//Router::add('/', "GET", MainController::index);