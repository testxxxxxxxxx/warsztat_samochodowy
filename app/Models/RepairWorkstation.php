<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class RepairWorkstation {
    public function get(int $number): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM STANOWISKO_NAPRAWCZE WHERE numer = :number";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":number", $number, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getAll(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM STANOWISKO_NAPRAWCZE";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(float $field, string $purpose): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO STANOWISKO_NAPRAWCZE(powierzchnia, przeznaczenie) VALUES(:field, :purpose)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":field", $field, PDO::PARAM_STR);
            $stmt->bindParam(":purpose", $purpose, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $number, float $field, string $purpose): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE STANOWISKO_NAPRAWCZE SET powierzchnia = :field, przeznaczenie = :purpose WHERE numer = :number";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":number", $number, PDO::PARAM_INT);
            $stmt->bindParam(":field", $field, PDO::PARAM_STR);
            $stmt->bindParam(":purpose", $purpose, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $number): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM STANOWISKO_NAPRAWCZE WHERE numer = :number";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":number", $number, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}