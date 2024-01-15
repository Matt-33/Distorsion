<?php
namespace config;

use PDO;

class Connexion {
    public static function connect() {
        $servername = "db.3wa.io";
        $username = "matthiasgiraudeau";
        $password = "fc5895cdd901a79bac212fd09194c4c4";
        $dbname = "matthiasgiraudeau_distorsion";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            die();
        }
    }
}

?>