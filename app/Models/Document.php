<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Document {
    public function get(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM DOKUMENT WHERE id_dok = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getJobs(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM DOKUMENT d INNER JOIN ZLECENIE z ON d.id_zlec = z.id_zlec";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $startDate, string $type, int $jobId): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO DOKUMENT(data_utworzenia, typ, id_zlec) VALUES(:startDate, :type, :jobId)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":startDate", $startDate, PDO::PARAM_STR);
            $stmt->bindParam(":type", $type, PDO::PARAM_STR);
            $stmt->bindParam(":jobId", $jobId);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $id, string $startDate, string $type, int $jobId): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE DOKUMENT SET data_utworzenia = :startDate, typ = :type, id_zlec = :jobId WHERE id_dok = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":startDate", $startDate, PDO::PARAM_STR);
            $stmt->bindParam(":type", $type, PDO::PARAM_STR);
            $stmt->bindParam(":jobId", $jobId);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $id): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM DOKUMENT WHERE id_dok = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}