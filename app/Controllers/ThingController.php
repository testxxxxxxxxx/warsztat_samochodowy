<?php
declare(strict_types = 1); 

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Thing;

class ThingController {

    public static function index(): TemplateEngine {
        $thing = new Thing();
        $things = $thing->getAll();

        return new TemplateEngine("thing_view.php", ["things" => $thing]);
    }
    public static function show(): TemplateEngine {
        $id = $_GET["id"];
        $thing = new Thing();
        $thingOne = $thing->get($id);

        return new TemplateEngine("thing_desc_view.php", ["thingOne" => $thingOne]);
    } 
    public static function create(): TemplateEngine {
        $name = $_POST["name"];
        $thing = new Thing();
        $createStatus = $thing->create($name);

        return new TemplateEngine("thing_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $thing = new Thing();
        $updateStatus = $thing->update($id, $name);

        return new TemplateEngine("thing_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $id = $_POST["id"];
        $thing = new Thing();
        $deleteStatus = $thing->delete($id);
        
        return new TemplateEngine("thing_view.php", ["status" => $deleteStatus]);
    }
}