<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Store {
    public function get(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM PRZECHOWALNIA p INNER JOIN KONTRACHENT k ON p.id_kontr = k.id_kontr and p.id_przech = :id INNER JOIN RZECZY_DO_PRZECHOWALNI r ON p.id_rzeczy = r.id_rzeczy and p.id_przech = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        } 
    }
    public function getAll(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM PRZECHOWALNIA p INNER JOIN KONTRACHENT k ON p.id_kontr = k.id_kontr INNER JOIN RZECZY_DO_PRZECHOWALNI r ON p.id_rzeczy = r.id_rzeczy";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $startDate, string $endDate, int $thingId, int $clientId): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO PRZECHOWALNIA(data_start, data_koniec, id_rzeczy, id_kontr) VALUES(:startDate, :endDate, :thingId, :clientId)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":startDate", $startDate, PDO::PARAM_STR);
            $stmt->bindParam(":endDate", $endDate, PDO::PARAM_STR);
            $stmt->bindParam(":thingId", $thingId, PDO::PARAM_INT);
            $stmt->bindParam(":clientId", $clientId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $id, string $startDate, string $endDate, int $thingId, int $clientId): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE PRZECHOWALNIA SET data_start = :startDate, data_koniec = :endDate, id_rzeczy = :thingId, id_kontr = :clientId WHERE id_przech = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":startDate", $startDate, PDO::PARAM_STR);
            $stmt->bindParam(":endDate", $endDate, PDO::PARAM_STR);
            $stmt->bindParam(":thingId", $thingId, PDO::PARAM_INT);
            $stmt->bindParam(":clientId", $clientId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $id) {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM PRZECHOWALNIA WHERE id_przech = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $sql, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}