<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\WorkerDesk;

class WorkerDeskController {
    public static function index(): TemplateEngine {
        $workerDesk = new WorkerDesk();
        $workers = $workerDesk->getAll();
        $workshops = $workerDesk->getWorkshops();
        $bosses = $workerDesk->getBosses();

        return new TemplateEngine("worker_desk_view.php", ["workers" => $workers, "workshops" => $workshops, "bosses" => $bosses]);
    }
    public static function show(): TemplateEngine {
        $id = $_GET["id"];
        $workerDesk = new WorkerDesk();
        $workerInfo = $workerDesk->get($id);

        return new TemplateEngine("worker_desk_desc_view.php", ["workerInfo" => $workerInfo]);
    }
    public static function create(): TemplateEngine {
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $empDate = $_POST["empDate"];
        $salary = $_POST["salary"];
        $roomNumber = $_POST["roomNumber"];
        $bonus = isset($_POST["bonus"])?$_POST["bonus"]:null; 
        $bossId = isset($_POST["bossId"])?$_POST["bossId"]:null;
        $workerDesk = new WorkerDesk();
        $createStatus = $workerDesk->create($name, $lastname, $empDate, $salary, $roomNumber, $bonus, $bossId);

        return new TemplateEngine("worker_desk_view.php", ["status" => $createStatus]);
    }
    public static function update(): TemplateEngine {
        $id = $_POST["id"];
        $name = $_POST["name"];
        $lastname = $_POST["lastname"];
        $empDate = $_POST["empDate"];
        $salary = $_POST["salary"];
        $roomNumber = $_POST["roomNumber"];
        $bonus = isset($_POST["bonus"])?$_POST["bonus"]:null; 
        $bossId = isset($_POST["bossId"])?$_POST["bossId"]:null;
        $workerDesk = new WorkerDesk();
        $updateStatus = $workerDesk->update($id, $name, $lastname, $empDate, $salary, $roomNumber, $bonus, $bossId);

        return new TemplateEngine("worker_desk_view.php", ["status" => $updateStatus]);
    }
    public static function delete(): TemplateEngine {
        $id = $_POST["id"];
        $workerDesk = new WorkerDesk();
        $deleteStatus = $workerDesk->delete($id);

        return new TemplateEngine("worker_desk_view.php", ["status" => $deleteStatus]);
    }
}