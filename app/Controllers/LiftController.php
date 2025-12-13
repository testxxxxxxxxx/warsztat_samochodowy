<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Lift;

class LiftController {
    public static function index(): TemplateEngine {
        $lift = new Lift();
        $lifts = $lift->getAll();
        return new TemplateEngine("lift_view.php", ["lifts" => $lifts]);
    }
    public static function show(): TemplateEngine {
        $id = $_GET["id"];
        $lift = new Lift();
        $liftInfo = $lift->get($id);
        return new TemplateEngine("lift_desc_view.php", ["liftInfo" => $liftInfo]);
    }
    public static function create(): TemplateEngine {
        $maxLift = $_POST["maxLift"];
        $lift = new Lift();
        $createStatus = $lift->create($maxLift);
        return new TemplateEngine("lift_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $id = $_POST["id"];
        $maxLift = $_POST["maxLift"];
        $lift = new Lift();
        $updateStatus = $lift->update($id, $maxLift);
        return new TemplateEngine("lift_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $id = $_POST["id"];
        $lift = new Lift();
        $deleteStatus = $lift->delete($id);
        return new TemplateEngine("lift_view.php", ["status" => $deleteStatus]);
    }
}