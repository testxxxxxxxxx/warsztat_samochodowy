<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class OrderWorkerWorkshop {
    public function create(int $workerId, int $orderId): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO ZLECENIE_PRACOWNIK_WARSZTAT(id_prac, id_zlec) VALUES(:workerId, :orderId)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":workerId", $workerId, PDO::PARAM_INT);
            $stmt->bindParam(":orderId", $orderId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $workerId, int $orderId): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM ZLECENIE_PRACOWNIK_WARSZTAT WHERE id_prac = :workerId and id_zlec = :orderId";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":workerId", $workerId, PDO::PARAM_INT);
            $stmt->bindParam(":orderId", $orderId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}