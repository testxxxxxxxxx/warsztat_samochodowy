<?php

declare(strict_types = 1);

namespace App\Models;

use App\Database\Database;
use \PDO;
use \PDOException;

class Client {
    public function get(int $id): array {
        try {
            $db = Database::connect();
            $sql = "SELECT * FROM KONTRACHENT WHERE ID_KONTR = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $err) {
            return [$err->getMessage()];
        }
    }
    public function create(string $name, string $phoneNumber, string $city, string $street, int $buildingNumber, string $nip, string $email): bool {
        try {
            $db = Database::connect();
            $sql = "INSERT INTO KONTRACHENT(nazwa, telefon, miejscowosc, ulica, numer_budynku, nip, email) VALUES(:name, :phoneNumber, :city, :street, :buildingNumber, :nip, :email)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(":city", $city, PDO::PARAM_STR);
            $stmt->bindParam(":street", $street, PDO::PARAM_STR);
            $stmt->bindParam(":buildingNumber", $buildingNumber, PDO::PARAM_INT);
            $stmt->bindParam(":nip", $nip, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
    public function update(int $id, string $phoneNumber, string $city, string $street, int $buildingNumber, string $nip, string $email): bool {
        try {
            $db = Database::connect();
            $sql = "UPDATE KONTRACHENT SET NAZWA=:name, telefon=:phoneNumber, miejscowosc=:city, ulica=:street, numer_budynku=:buildingNumber, nip=:nip, email=:email WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":phoneNumber", $phoneNumber, PDO::PARAM_STR);
            $stmt->bindParam(":city", $city, PDO::PARAM_STR);
            $stmt->bindParam(":street", $street, PDO::PARAM_STR);
            $stmt->bindParam(":buildingNumber", $buildingNumber, PDO::PARAM_INT);
            $stmt->bindParam(":nip", $nip, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();
            return true; 
        } catch(PDOException $err) {
            return false;
        }
    }
    public function delete(int $id): bool {
        try {
            $db = Database::connect();
            $sql = "DELETE FROM KONTRACHENT WHERE id=:id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch(PDOException $err) {
            return false;
        }
    }
}