<?php

$user = "root";
$pass = "";
$dbName = "conge-facile";

try {
    $bdd = new \PDO("mysql:host=127.0.0.1;dbname=$dbName;charset=UTF8", $user, $pass);
} catch (\Exception $exception) {
    echo 'Erreur lors de la connexion à la base de données.<br>';
    echo $exception->getMessage();
    exit;
}
