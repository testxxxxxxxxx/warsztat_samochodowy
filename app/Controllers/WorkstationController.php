<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Workstation;

class WorkstationController {
    public static function index(): TemplateEngine {
        $workstation = new Workstation();
        $workstations = $workstation->getAll();

        return new TemplateEngine("workstation_view.php", ["workstations" => $workstations]);
    }
    public static function show(): TemplateEngine {
        $workstation = new Workstation();
        $repairName = isset($_GET["repairName"])?$_GET["repairName"]:"";
        $inspectName = isset($_GET["inspectName"])?$_GET["inspectName"]:""; 
        $repairs = $workstation->getRepair($repairName);
        $inspects = $workstation->getInspect($inspectName);
        
        return new TemplateEngine("workstation_desc_view.php", ["repairs" => $repairs, "inspects" => $inspects]);
    }
    public static function create(): TemplateEngine {
        $workstation = new Workstation();
        $name = $_POST["name"];
        $description = $_POST["description"];
        $repairId = $_POST["repairId"];
        $inspectId = $_POST["inspectId"];
        $createStatus = $workstation->create($name, $description, $repairId, $inspectId);
        
        return new TemplateEngine("workstation_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $workstation = new Workstation();
        $name = $_POST["name"];
        $description = $_POST["description"];
        $repairId = $_POST["repairId"];
        $inspectId = $_POST["inspectId"];
        $updateStatus = $workstation->update($name, $description, $repairId, $inspectId);
        
        return new TemplateEngine("workstation_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $workstation = new Workstation();
        $name = $_POST["name"];
        $deleteStatus = $workstation->delete($name);

        return new TemplateEngine("workstation_view.php", ["status" => $deleteStatus]);
    }
}