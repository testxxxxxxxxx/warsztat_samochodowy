<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Thing {
    public function get(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM RZECZY_DO_PRZECHOWALNI WHERE id_rzeczy = :id";
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
            $sql = "SELECT * FROM RZECZY_DO_PRZECHOWALNI";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $name): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO RZECZY_DO_PRZECHOWALNI(nazwa) VALUES(:name)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $id, string $name): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE RZECZY_DO_PRZECHOWALNI SET nazwa = :name WHERE id_rzeczy = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $id): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM RZECZY_DO_PRZECHOWALNI WHERE id_rzeczy = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }    
}