<?php
declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Commodity {
    public function get(string $code): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM TOWAR t INNER JOIN KONTRACHENT_TOWAR kt ON t.KOD_MAGAZYM = kt.KOD_MAGAZYM INNER JOIN KONTRACHENT k ON kt.id_kontr = k.id_kontr WHERE t.KOD_MAGAZYM = :code";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":code", $code, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function getAll(): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM TOWAR t INNER JOIN KONTRACHENT_TOWAR kt ON t.KOD_MAGAZYM = kt.KOD_MAGAZYM INNER JOIN KONTRACHENT k ON kt.id_kontr = k.id_kontr";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $code, string $name, string $ean, string $description, float $bought, float $sell, float $tax): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO TOWAR(kod_magazyn, nazwa, ean, opis, zakup, 'sprzedaż', podatek) VALUES(:code, :name, :ean, :description, :bought, :sell, :tax)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":code", $code, PDO::PARAM_STR);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":ean", $ean, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":bought", $bought, PDO::PARAM_STR);
            $stmt->bindParam(":sell", $sell, PDO::PARAM_STR);
            $stmt->bindParam(":tax", $tax, PDO::PARAM_STR);
            $stmt->execute();

            return true ;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(string $code, string $name, string $ean, string $description, float $bought, float $sell, float $tax): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE TOWAR SET nazwa = :name, ean = :ean, opis = :description, zakup = :bought, 'sprzedaż' = :sell, podatek = :tax WHERE kod_magazyn = :code";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":code", $code, PDO::PARAM_STR);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":ean", $ean, PDO::PARAM_STR);
            $stmt->bindParam(":description", $description, PDO::PARAM_STR);
            $stmt->bindParam(":bought", $bought, PDO::PARAM_STR);
            $stmt->bindParam(":sell", $sell, PDO::PARAM_STR);
            $stmt->bindParam(":tax", $tax, PDO::PARAM_STR);
            $stmt->execute();
            
            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(string $code): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM TOWAR WHERE kod_magazyn = :code";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":code", $code, PDO::PARAM_STR);
            $stmt->execute();

            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}