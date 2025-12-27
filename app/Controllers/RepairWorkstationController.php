<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\RepairWorkstation;

class RepairWorkstationController {
    public static function index(): TemplateEngine {
        $repairWorkstation = new RepairWorkstation();
        $repairWorkstations = $repairWorkstation->getAll();

        return new TemplateEngine("repair_workstation_view.php", ["repairWorkstations" => $repairWorkstations]);
    }
    public static function show(): TemplateEngine {
        $number = $_GET["number"];
        $repairWorkstation = new RepairWorkstation();
        $repairWork = $repairWorkstation->get($number);
        
        return new TemplateEngine("repair_workstation_desc_view.php", ["repairWork" => $repairWork]);
    }
    public static function create(): TemplateEngine {
        $field = $_POST["field"];
        $purpose = $_POST["purpose"];
        $repairWorkstation = new RepairWorkstation();
        $createStatus = $repairWorkstation->create($field, $purpose);
        
        return new TemplateEngine("repair_workstation_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $number = $_POST["number"];
        $field = $_POST["field"];
        $purpose = $_POST["purpose"];
        $repairWorkstation = new RepairWorkstation();
        $updateStatus = $repairWorkstation->update($number, $field, $purpose);
        
        return new TemplateEngine("repair_workstation_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $number = $_POST["number"];
        $repairWorkstation = new RepairWorkstation();
        $deleteStatus = $repairWorkstation->delete($number);

        return new TemplateEngine("repair_workstation_view.php", ["status" => $deleteStatus]);
    }
}