<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class CommodityOrder {
    public function create(string $shopCode, int $orderId): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO TOWAR_ZLECENIE(kod_magazyn, id_zlec) VALUES(:shopCode, :orderId)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":shopCode", $shopCode, PDO::PARAM_STR);
            $stmt->bindParam(":orderId", $orderId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    } 
    public function delete(string $shopCode, int $orderId): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM TOWAR_ZLECENIE WHERE kod_magazyn = :shopCode and id_zlec = :orderId";
            $stmt = $db->prepare($sql);
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":shopCode", $shopCode, PDO::PARAM_STR);
            $stmt->bindParam(":orderId", $orderId, PDO::PARAM_INT);
            $stmt->execute();

            return true;

        } catch(PDOException $err) {
            return false;
        }
    }
}