<?php
declare(strict_types=1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Car {
    public function get(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM POJAZD WHERE id_poj = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $registrationNumber, string $mark, string $model, float $engine, float $horsePower, float $power, string $type, int $year, int $mileage): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO POJAZD(nr_rej, marka, model, silnik, konie_mech, moc, typ, rok_prod, przebieg) VALUES(:registrationNumber, :mark, :model, :engine, :horsePower, :power, :type, :year, :mileage)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":registrationNumber", $registrationNumber, PDO::PARAM_STR);
            $stmt->bindParam(":mark", $mark, PDO::PARAM_STR);
            $stmt->bindParam(":model", $model, PDO::PARAM_STR);
            $stmt->bindParam(":engine", $engine, PDO::PARAM_STR);
            $stmt->bindParam(":horsePower", $horsePower, PDO::PARAM_STR);
            $stmt->bindParam(":power", $power, PDO::PARAM_STR);
            $stmt->bindParam(":type", $type, PDO::PARAM_STR);
            $stmt->bindParam(":year", $year, PDO::PARAM_INT);
            $stmt->bindParam(":mileage", $mileage, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $id, string $registrationNumber, string $mark, string $model, float $engine, float $horsePower, float $power, string $type, int $year, int $mileage) {
        try {
            $db = Database::connect();
            $sql = "UPDATE POJAZD SET nr_rej = :registrationNumber, marka = :mark, silnik = :engine, konie_mech = :horsePower, moc = :power, typ = :type, rok = :year, przebieg = :mileage WHERE id_poj = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":registrationNumber", $registrationNumber, PDO::PARAM_STR);
            $stmt->bindParam(":mark", $mark, PDO::PARAM_STR);
            $stmt->bindParam(":model", $model, PDO::PARAM_STR);
            $stmt->bindParam(":engine", $engine, PDO::PARAM_STR);
            $stmt->bindParam(":horsePower", $horsePower, PDO::PARAM_STR);
            $stmt->bindParam(":power", $power, PDO::PARAM_STR);
            $stmt->bindParam(":type", $type, PDO::PARAM_STR);
            $stmt->bindParam(":year", $year, PDO::PARAM_INT);
            $stmt->bindParam(":mileage", $mileage, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $id): bool{
        try {
            $db = Database::connect();
            $sql = "DELETE FROM POJAZD WHERE id_poj = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
            
        } catch(PDOException $err) {
            return false;
        }
    }
}