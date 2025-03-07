<?php

$servername = 'localhost';
$username = 'root';
$password_db = '';
try {
    $bdd = new PDO("mysql:host=$servername;dbname=congeFacile", $username, $password_db);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Erreur lors de la connexion à la base de données.<br>';
    echo $exception->getMessage();
    exit;
}
