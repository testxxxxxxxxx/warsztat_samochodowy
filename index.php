<?php
declare(strict_types = 1);

namespace App;

require_once "./vendor/autoload.php";
require "./Routing/Router.php";
require "./Controllers/MainController.php";

use App\Routing\Router;
use App\Controllers\MainController;

//start router
Router::accept($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

//new pages define
//for example
//Router::add('/', "GET", MainController::index);