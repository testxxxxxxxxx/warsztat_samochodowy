<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class InspectionWorkstation {
    public function get(int $number): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM STANOWISKO_INSPEKCYJNE WHERE numer = :number";
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
            $sql = "SELECT * FROM STANOWISKO_INSPEKCYJNE";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(float $field, int $certificateNumber): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO STANOWISKO_INSPEKCYJNE(powierzchnia, numer_certyfikatu) VALUES(:field, :certificateNumber)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":field", $field, PDO::PARAM_STR);
            $stmt->bindParam(":certificateNumber", $certificateNumber, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $number, float $field, int $certificateNumber): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE STANOWISKO_INSPEKCYJNE SET powierzchnia = :field, numer_certyfikatu = :certificateNumber WHERE numer = :number";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":number", $number, PDO::PARAM_INT);
            $stmt->bindParam(":field", $field, PDO::PARAM_STR);
            $stmt->bindParam(":certificateNumber", $certificateNumber, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $number): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM STANOWISKO_INSPEKCYJNE WHERE numer = :number";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":number", $number, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}