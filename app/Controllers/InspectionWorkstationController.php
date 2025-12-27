<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\InspectionWorkstation;

class InspectionWorkstationController {
    public static function index(): TemplateEngine {
        $inspectionWorkstation = new InspectionWorkstation();
        $inspectionWorkstations = $inspectionWorkstation->getAll();

        return new TemplateEngine("inspection_workstation_view.php", ["inspectionWorkstations" => $inspectionWorkstations]);
    }
    public static function show(): TemplateEngine {
        $number = $_GET["number"];
        $inspectionWorkstation = new InspectionWorkstation();
        $inspectionWork = $inspectionWorkstation->get($number);
        
        return new TemplateEngine("inspection_workstation_desc_view.php", ["inspectionWork" => $inspectionWork]);
    }
    public static function create(): TemplateEngine {
        $field = $_POST["field"];
        $certificateNumber = $_POST["certificateNumber"];
        $inspectionWorkstation = new InspectionWorkstation();
        $createStatus = $inspectionWorkstation->create($field, $certificateNumber);
        
        return new TemplateEngine("inspection_workstation_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $number = $_POST["number"];
        $field = $_POST["field"];
        $certificateNumber = $_POST["certificateNumber"];
        $inspectionWorkstation = new InspectionWorkstation();
        $updateStatus = $inspectionWorkstation->update($number, $field, $certificateNumber);
        
        return new TemplateEngine("inspection_workstation_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $number = $_POST["number"];
        $inspectionWorkstation = new InspectionWorkstation();
        $deleteStatus = $inspectionWorkstation->delete($number);

        return new TemplateEngine("inspection_workstation_view.php", ["status" => $deleteStatus]);
    }
}