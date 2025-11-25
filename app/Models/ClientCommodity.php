<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class ClientCommodity {
    public function create(int $clientId, string $code): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO KONTRACHENT_TOWAR(id_kontr, kod_magazyn) VALUES(:clientId, :code)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":clientId", $clientId, PDO::PARAM_INT);
            $stmt->bindParam(":code", $code, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $clientId, string $code): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE KONTRACHENT_TOWAR SET id_kontr = :clientId, kod_magazyn = :code WHERE id_kontr = :clientId or kod_magazyn = :code";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":clientId", $clientId, PDO::PARAM_INT);
            $stmt->bindParam(":code", $code, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $clientId, string $code): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM KONTRACHENT_TOWAR WHERE id_kontr = :clientId or kod_magazyn = :code";
            $stmt->bindParam(":clientId", $clientId, PDO::PARAM_INT);
            $stmt->bindParam(":code", $code, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}