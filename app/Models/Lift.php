<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Lift {
    public function get(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM 'podnośnik' WHERE nr_podn = :id";
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
            $sql = "SELECT * FROM 'podnośnik'";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(float $maxLift): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO 'podnośnik'('max_udźwig') VALUES(:maxLift)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":maxLift", $maxLift, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $id, float $maxLift): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE 'podnośnik' SET 'max_udźwig' = :maxLift WHERE nr_podn = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":maxLift", $maxLift, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $id): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM 'podnośnik' WHERE nr_podn = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}