<?php

namespace models;

use PDO;

class Categorie {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllCategoriesWithSalons() {
        $query = "SELECT c.*, s.Id as Salon_Id, s.name as Salon_name FROM Categorie c LEFT JOIN Salon s ON c.Id = s.categorie_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $categories = [];

        foreach ($result as $row) {
            $categoryId = $row['Id'];

            if (!isset($categories[$categoryId])) {
                // Nouvelle catégorie, initialisez ses données
                $categories[$categoryId] = [
                    'Id' => $categoryId,
                    'name' => $row['name'],
                    'Salon' => [],
                ];
            }

            // Ajoutez le salon à la catégorie
            if (!empty($row['Salon_Id'])) {
                $categories[$categoryId]['Salon'][] = [
                    'Id' => $row['Salon_Id'],
                    'name' => $row['Salon_name'],
                ];
            }
        }

        return array_values($categories);
    }
    
      public function getAllCategories() {
        $query = "SELECT * FROM Categorie";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNewCategory($name) {
        $query = "INSERT INTO Categorie (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name);
        return $stmt->execute();
    }
}
?>