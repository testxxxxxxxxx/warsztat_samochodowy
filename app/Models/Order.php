<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Order {
    public function getAll(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM ZLECENIA";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getCar(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM ZLECENIA z INNER JOIN POJAZD p ON z.id_poj = p.id_poj WHERE id_zlec = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getWorker(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM ZLECENIA z INNER JOIN POJAZD p ON z.id_prac = p.id_prac WHERE id_zlec = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getCarAll(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM ZLECENIA z INNER JOIN POJAZD p ON z.id_poj = p.id_poj";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getWorkerAll(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM ZLECENIA z INNER JOIN POJAZD p ON z.id_prac = p.id_prac";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $startDate, string $endDate, string $description, string $createdDate, string $state, int $carId, int $workerId): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO ZLECENIA(data_rozpoczecia, data_zakonczenia, opis, data_utworzenia, status, id_poj, id_prac) VALUES(:startDate, :endDate, :description, :createdDate, :state, :carId, :workerId)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":startDate", $startDate, PDO::PARAM_STR);
            $stmt->bindParam(":endDate", $endDate, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":createdDate", $createdDate, PDO::PARAM_STR);
            $stmt->bindParam(":state", $state, PDO::PARAM_STR);
            $stmt->bindParam(":carId", $carId, PDO::PARAM_INT);
            $stmt->bindParam(":workerId", $workerId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $id, string $startDate, string $endDate, string $description, string $createdDate, string $state, int $carId, int $workerId): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE ZLECENIA SET data_rozpoczecia = :startDate, data_zakonczenia = :endDate, opis = :description, data_utworzenia = :createdDate, status = :state, id_poj = :carId, id_prac = :workerId WHERE id_zlec = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":startDate", $startDate, PDO::PARAM_STR);
            $stmt->bindParam(":endDate", $endDate, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":createDate", $createdDate, PDO::PARAM_STR);
            $stmt->bindParam(":state", $state, PDO::PARAM_STR);
            $stmt->bindParam(":carId", $carId, PDO::PARAM_INT);
            $stmt->bindParam(":workerId", $workerId, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $id): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM ZLECENIA WHERE id_zlec = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}