<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\WorkerWorkshop;

class WorkerWorkshopController {
    public static function index(): TemplateEngine {
        $workerWorkshop = new WorkerWorkshop();
        $workers = $workerWorkshop->getAll();
        $workshops = $workerWorkshop->getWorkshops();
        $bosses = $workerWorkshop->getBosses();

        return new TemplateEngine("worker_work_view.php", ["workers" => $workers, "workshops" => $workshops, "bosses" => $bosses]);
    }
    public static function show(): TemplateEngine {
        $id = $_GET["id"];
        $workerWorkshop = new WorkerWorkshop();
        $workerInfo = $workerWorkshop->get($id);

        return new TemplateEngine("worker_work_desc_view.php", ["workerInfo" => $workerInfo]);
    }
    public static function create(): TemplateEngine {
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $empDate = $_POST["empDate"];
        $salary = $_POST["salary"];
        $hallNumber = $_POST["hallNumber"];
        $bonus = isset($_POST["bonus"])?$_POST["bonus"]:null; 
        $bossId = isset($_POST["bossId"])?$_POST["bossId"]:null;
        $workerWorkshop = new WorkerWorkshop();
        $createStatus = $workerWorkshop->create($name, $lastname, $empDate, $salary, $hallNumber, $bonus, $bossId);

        return new TemplateEngine("worker_work_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $empDate = $_POST["empDate"];
        $salary = $_POST["salary"];
        $hallNumber = $_POST["hallNumber"];
        $bonus = isset($_POST["bonus"])?$_POST["bonus"]:null; 
        $bossId = isset($_POST["bossId"])?$_POST["bossId"]:null;
        $workerWorkshop = new WorkerWorkshop();
        $updateStatus = $workerWorkshop->update($id, $name, $lastname, $empDate, $salary, $hallNumber, $bonus, $bossId);

        return new TemplateEngine("worker_work_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $id = $_POST["id"];
        $workerWorkshop = new WorkerWorkshop();
        $deleteStatus = $workerWorkshop->delete($id);

        return new TemplateEngine("worker_work_view.php", ["status" => $deleteStatus]);
    }
}