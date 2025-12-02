<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class WorkerWorkshop {
    public function get(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM PRACOWNIK_WARSZTAT WHERE id_prac = :id";
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
            $sql = "SELECT * FROM PRACOWNIK_WARSZTAT";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getBosses(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT p.nazwisko, p.imie, COUNT(*) AS ile_podwladnych FROM PRACOWNIK_WARSZTAT p INNER JOIN PRACOWNIK_BIURO s ON p.id_prac = s.szef GROUP BY s.szef ASC";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $name, string $lastname, string $empDate, float $salary, int $hallNumber, float $bonus = null, int $bossId = null): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO PRACOWNIK_WARSZTAT(imie, nazwisko, data_zatrudnienia, placa, premia, szef, nr_hali) VALUES(:name, :lastname, :empDate, :salary, :bonus, :bossId, :hallNumber)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":salary", $salary, PDO::PARAM_STR);
            $stmt->bindParam(":bonus", $bonus, PDO::PARAM_STR);
            $stmt->bindParam(":bossId", $bossId, PDO::PARAM_INT);
            $stmt->bindParam(":hallNumber", $hallNumber, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $id, string $name, string $lastname, string $empDate, float $salary, int $hallNumber, float $bonus = null, int $bossId = null): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE PRACOWNIK_WARSZTAT SET imie = :name, nazwisko = :lastname, data_zatrudnienia = :empDate, placa = :salary, premia = :bonus szef = :bossId, nr_hali = :hallNumber WHERE id_prac = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":lastname", $lastname, PDO::PARAM_STR);
            $stmt->bindParam(":salary", $salary, PDO::PARAM_STR);
            $stmt->bindParam(":bonus", $bonus, PDO::PARAM_STR);
            $stmt->bindParam(":bossId", $bossId, PDO::PARAM_INT);
            $stmt->bindParam(":hallNumber", $hallNumber, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $id): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM PRACOWNIK_WARSZTAT WHERE id_prac = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}