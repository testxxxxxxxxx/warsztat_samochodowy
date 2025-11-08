<?php

declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Client {
    public function getName(int $id): array | string{
        try {
            $db = Database::connect();
            $sql = "SELECT NAZWA FROM KONTRACHENT WHERE ID_KONTR = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return $err->getMessage();
        }
    }
}