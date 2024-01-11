<?php
include 'config/Connexion.php';
include 'controllers/CategorieController.php';
include 'controllers/SalonController.php';
include 'controllers/MessageController.php';

$action = $_GET['action'] ?? 'displayCategories';
$template = '';

$categorieController = new CategorieController($conn);
$salonController = new SalonController($conn);

switch ($action) {
    case 'displayCategories':
        $template = 'view/displayCategorie.phtml';
        $categories = $categorieController->displayCategoriesTemplate();
        break;
    case 'showCreateCategoryForm':
        
        $template = $categorieController->showCreateCategoryFormTemplate();
        break;
    case 'createCategory':
        $message = $categorieController->createCategory();
        if ($message !== "") {
       
            $template = $message;
        } else {
       
            $template = $categorieController->displayCategoriesTemplate();
        }
        break;
    
     case 'createSalon':
        $template = $salonController->showCreateSalonFormTemplate(); // Affiche le formulaire de création de salon
        break;
    case 'createNewSalon':
    $message = $salonController->createSalon();
    if ($message !== "") {
        $template = $message;
    } else {
        header("Location: index.php");
        exit();
    }
    break;
    case 'goToAbout':
       
        $template = 'view/Apropos.phtml';
        break;
    case 'redirectToChat':
        header("Location: index.php");
        break;
        
 case 'displaySalon':
    $salonId = $_GET['SalonId'] ?? null;

    if ($salonId !== null) {
        // Instanciez vos modèles ici
        $salonModel = new Salon($conn);
        $messageModel = new Message($conn);

        // Chargez le nom du salon spécifié
        $nomDuSalon = $salonModel->getSalonNameById($salonId);

        // Chargez les messages du salon spécifié
        $messages = $messageModel->getMessagesBySalon($salonId);

        // Mettez à jour la variable $template pour inclure le template du chat
        $template = 'view/chat.phtml';
    } else {
        // Redirigez vers la page principale si l'ID du salon n'est pas spécifié
        header("Location: index.php");
        exit();
    }
    break;
    
    case 'sendMessage':
    $messageController = new MessageController($conn);
    $messageController->createMessage();
    // Redirigez vers la page du salon après l'envoi du message
    header("Location: index.php?action=displaySalon&SalonId=$salonId");
    exit();
    break;

}
include 'view/layout/layout.phtml';
?>