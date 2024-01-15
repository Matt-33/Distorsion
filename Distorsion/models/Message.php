<?php 

namespace models;

use PDO;

class Message {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getMessagesBySalon($salon_id) {
        $query = "SELECT * FROM Message WHERE salon_id = :salon_id ORDER BY date_envoi";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':salon_id', $salon_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createNewMessage($contenu, $date_envoi, $salon_id) {
    $query = "INSERT INTO Message (contenu, date_envoi, salon_id) VALUES (:contenu, :date_envoi, :salon_id)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':contenu', $contenu);
    $stmt->bindParam(':date_envoi', $date_envoi);
    $stmt->bindParam(':salon_id', $salon_id);
    return $stmt->execute();
}
}
?>