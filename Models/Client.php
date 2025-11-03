<?php

declare(strict_types = 1);

namespace App\Models;

class Client {
    public function getName(int $id): string {
        try {
            $db = new PDO($_ENV["dsn"], $_ENV["user"], $_ENV["password"]);
            $sql = "SELECT NAZWA FROM KONTRACHENT WHERE ID_KONTR = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC)["NAZWA"];
        } catch(PDOException $err) {
            return $err->getMessage();
        }
    }
}