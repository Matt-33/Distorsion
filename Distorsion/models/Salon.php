<?php

namespace models;

use PDO;

class Salon {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllSalons() {
        $query = "SELECT * FROM Salon";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   public function getSalonsByCategory($category_id) {
        $query = "SELECT * FROM Salon WHERE categorie_id = :categorie_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':categorie_id', $category_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNewSalon($name, $categorie_id) {
        $query = "INSERT INTO Salon (name, categorie_id) VALUES (:name, :categorie_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':categorie_id', $categorie_id);
        return $stmt->execute();
    }
    
    public function getSalonNameById($salonId) {
    $query = "SELECT name FROM Salon WHERE Id = :salonId";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':salonId', $salonId);
    $stmt->execute();
    return $stmt->fetchColumn(); // Retourne le nom du salon
}
}
?>