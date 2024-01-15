<?php

namespace controllers;

use config\Connexion;
use models\Message;

class MessageController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createMessage() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['MessageContent'])) {
            $content = $_POST['MessageContent'];
            $date_envoi = date('Y-m-d H:i:s');
            $salon_id = $_POST['SalonId'];

            $messageModel = new Message($this->conn);
            $messageModel->createNewMessage($content, $date_envoi, $salon_id);

            // Rediriger vers la page du salon après l'envoi du message
            header("Location: index.php?action=displaySalon&SalonId=$salon_id");
            exit();
        }
    }
}
?>