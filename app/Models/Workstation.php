<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Workstation {
    public function getRepair(string $name): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM STANOWISKO s INNER JOIN STANOWISKO_NAPRAWCZE sn ON s.stanowisko_naprawcze = sn.number and nazwa = :name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getInspect(string $name): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM STANOWISKO s INNER JOIN STANOWISKO_INSPEKCYJNE si ON s.stanowisko_inspekcyjne = si.number and nazwa = :name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getAll(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM STANOWISKO s, STANOWISKO_NAPRAWCZE sn, STANOWISKO_INSPEKCYJNE si WHERE s.stanowisko_naprawcze = sn.number or s.stanowisko_inspekcyjne = si.number";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $name, string $description, int $repairId, int $insId): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO STANOWISKO(nazwa, opis, repairId, insId) VALUES(:name, :description, :repairId, :insId)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":repairId", $repairId, PDO::PARAM_INT);
            $stmt->bindParam(":insId", $insId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(string $name, string $description, int $repairId, int $insId): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE STANOWISKO SET opis = :description, repairId = :repairId, insId = :insId WHERE nazwa = :name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":repairId", $repairId, PDO::PARAM_INT);
            $stmt->bindParam(":insId", $insId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(string $name): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM STANOWISKO WHERE nazwa = :name";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}