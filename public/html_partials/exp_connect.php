<?php
//On créer les variables de connection
$server = "localhost";
$login = "root";
$pass = "";

//On tente la connection au serveur
try {
    $conn = new PDO("mysql:host=$server;dbname=exp;charset=utf8", $login, $pass);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Connexion à la BDD réussie <br/>';
} catch (PDOException $e) {
    echo 'Echec de la connexion : '.$e->getMessage();
}
?>