<?php
class Create {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function CreateData($nom , $email) {
        $query = "INSERT INTO  utilisateur ( nom , mot_de_passe) VALUES (:nom , :mot_de_passe)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nom" , $nom);
        $stmt->bindParam(":mot_de_passe" , $mot_de_passe);
        if($stmt-> execute()) {
            return true;
        } else {
            return false;
        }
    }
}

?>