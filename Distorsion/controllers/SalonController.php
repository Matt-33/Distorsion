<?php
include 'models/Salon.php';

class SalonController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   public function displaySalonLayout() {
        $categorieModel = new Categorie($this->conn);
        $categories = $categorieModel->getAllCategories();

        $salonModel = new Salon($this->conn);
        $salons = $salonModel->getAllSalons();

        return $salons;
    }
    
    public function showCreateSalonFormTemplate() {
        $categorieModel = new Categorie($this->conn);
        $categories = $categorieModel->getAllCategories();

        return 'view/formulaire/create_salon.phtml';
    }

    public function createSalon() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['SalonName']) && isset($_POST['CategorieId'])) {
        $name = $_POST['SalonName'];
        $categoryId = $_POST['CategorieId'];

        $salonModel = new Salon($this->conn);
        $success = $salonModel->createNewSalon($name, $categoryId);

        if (!$success) {
            return "Une erreur est survenue lors de la création du salon.";
        } else {
            // Redirection vers une autre page ou traitement supplémentaire si nécessaire
            header("Location: index.php");
            exit();
        }
    }
}
}
?>