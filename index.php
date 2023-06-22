<?php

session_start();

include_once './classes/auth.php';
include_once './config/config.php';
include_once './classes/create.php';
include_once './classes/read.php';
include_once './classes/update.php';
include_once './classes/delete.php';

$database = new Database();
$db = $database->getConnection();

// create instance class CRUD

$auth = new Auth($db);
$create = new Create($db);
$read = new Read($db);
$delete = new Delete($db);
$update = new Update($db);
$inscription = new Inscription($db);


if($auth->IsAuthenficated()) {
    header('Location : login.php');
    exit();
}

if(!$auth->IsModerator() && !$auth->IsAdmin()) {
    header('Location : index.php');
    exit();
}


if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];

    if($delete->deleteData($id)) {
        echo "bien delete";
    } else {
        echo "Erreur";
    }
};


$stmt = $read->readData();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "ID : " .$row['id']. "<br>";
    echo "Nom : " .$row['nom']. "<br>";
    echo "Email : " .$row['email']. "<br>";
    // update
    echo "<form action='./update.php' method='POST'>";
    echo "<input type='hidden' name='id' value= '".$row['id']."'>";
    echo "<input type='text' name='nom' value= '".$row['nom']."'>";
    echo "<input type='text' name='email' value= '".$row['email']."'>";
    echo "<input type='submit' value='Mettre à jour'>";
    echo "</form>";

    // delete

    echo "<form action='".$_SERVER['PHP_SELF']. "' method='POST'>";
    echo "<input type='hidden' name='id' value= '".$row['id']."'>";
    echo "<input type='submit'  name='delete' value='sup'>";
    echo "</form>";
    echo "<br>";
}









?>