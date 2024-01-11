<?php
include 'models/Categorie.php';

class CategorieController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function displayCategoriesTemplate() {
        $categorieModel = new Categorie($this->conn);
        $categories = $categorieModel->getAllCategoriesWithSalons(); // Utilisez la méthode correcte

        return $categories;
    }

    public function showCreateCategoryFormTemplate() {
        $categorieModel = new Categorie($this->conn);
        $categories = $categorieModel->getAllCategories();

        return 'view/formulaire/create_categorie.phtml';
    }

    public function createCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['CategorieName'])) {
            $name = $_POST['CategorieName'];

            $categorieModel = new Categorie($this->conn);
            $success = $categorieModel->createNewCategory($name);

            if (!$success) {
                return "Une erreur est survenue lors de la création de la catégorie.";
            } else {
                header("Location: index.php");
                exit();
            }
        }
    }
}
?>