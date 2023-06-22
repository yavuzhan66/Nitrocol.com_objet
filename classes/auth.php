<?php

include_once 'inscription.php';

Class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }
 
    public function inscription($nom_utilisateur, $mot_de_passe){
        $inscription = new Inscription($this->conn);
        return $inscription->enregistrerUtilisateur($nom_utilisateur, $mot_de_passe);
    }

    public function login($nom_utilisateur, $mot_de_passe){
        $query = "SELECT * FROM utilisateur WHERE nom_utilisateur = :nom_utilisateur";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nom_utilisateur", $nom_utilisateur);
        $stmt->execute();

        if($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $hashedPasseword = $user['mot_de_passe'];

            if(password_verify($mot_de_passe, $hashedPasseword )) {
                $_SESSION['nom_utilisateur'] = $user['nom_utilisateur'];
                $_SESSION['utilisateur_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                return true;
            }
        }

        return false;
    }

    public function IsAuthenficated(){
        return isset($_SESSION['nom_utlisateur']);
    }

    public function IsModerator(){
        return isset($_SESSION['role']) && $_SESSION['role'] === 'modérateur';
    }

    public function IsAdmin(){
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

    }

}
?>