<?php


class Inscription {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function enregistrerUtilisateur($nom_utilisateur, $mot_de_passe) {
        $query = "SELECT id FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nom_utilisateur" , $nom_utilisateur);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            return "Ce nom à déjà été pris, désolé...";
        } else {
            $query = "INSERT INTO utilisateur (nom_utilisateur, mot_de_passe, role) VALUES (:nom_utilisateur, :mot_de_passe, 'utilisateur')";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":nom_utilisateur" , $nom_utilisateur);
            $hashedPasseword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
            $stmt->bindParam(":mot_de_passe" , $hashedPasseword);
            
            if($stmt->execute()){
                return "C'est bon";
            } else {
                return "erreur";
            }
        }
    }
    
}

?>
