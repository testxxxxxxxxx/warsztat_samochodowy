<?php
declare(strict_types = 1);

namespace App\Controllers;

use App\Logic\TemplateEngine;
use App\Models\Document;
use App\Models\Order;

class DocumentController {
    public static function index(): TemplateEngine {
        $document = new Document();
        $order = new Order();
        $documentsAndJobs = $document->getJobs();
        $orders = $order->getAll();
        return new TemplateEngine("document_view.php", ["documentsAndJobs" => $documentsAndJobs, "orders" => $orders]);
    }
    public static function show(): TemplateEngine {
        $id = $_GET["id"];
        $document = new Document();
        $documentAndJob = $document->get($id);
        return new TemplateEngine("document_description_view.php", ["documentAndJob" => $documentAndJob]);
    }
    public static function create(): TemplateEngine {
        $startDate = $_POST["startDate"];
        $type = $_POST["type"];
        $jobId = $_POST["jobId"];
        $document = new Document();
        $status = $document->create($startDate, $type, $jobId);
        return new TemplateEngine("document_view.php", ["status" => $status]);
    }
    public static function update(): TemplateEngine {
        $id = $_POST["id"];
        $startDate = $_POST["startDate"];
        $type = $_POST["type"];
        $jobId = $_POST["jobId"];
        $document = new Document();
        $status = $document->update($id, $startDate, $type, $jobId);
        return new TemplateEngine("document_view.php", ["status" => $status]);
    }
    public static function delete(): TemplateEngine {
        $id = $_POST["id"];
        $document = new Document();
        $status = $document->delete($id);
        return new TemplateEngine("docuement_view.php", ["status" => $status]);
    }
}