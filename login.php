<?php
session_start();
include_once './config/config.php';
include_once './classes/auth.php';

$database = new Database();
$db = $database->getConnection();
$auth = new Auth($db);

if ($auth->IsAuthenficated()) {
    header('Location: index.php');
    exit();


    if($SERVER['REQUEST_METHOD'] === 'POST') {
        $nom_utilisateur + $_POST['nom_utilisateur'];
        $mot_de_passe + $_POST['mot_de_passe'];

    }



    if($auth->login($nom_utilisateur, $mot_de_passe)) {
        header('Location : index.php');
        exit();
    } else {
        echo "pas bon";
    }
}



?>













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<body>
    
<form action="login.php" method="POST">
        <div>
            <label for="nom_utilisateur"></label>
            <input type="text" name="nom_utilisateur" placeholder="nom" required>
        </div>

        <div>
            <label for="mot_de_passe"></label>
            <input type="text" name="mot_de_passe" placeholder="password" required>
        </div>

        <div>
            <input type="submit" value="Se connecter">
        </div>
    </form>




   


































    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>