<?php
class Update {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function updateData($id, $nom , $mot_de_passe) {
        $query = "UPDATE utilisateur SET nom = :nom, mot_de_passe = :mot_de_passe WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id" , $id);
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