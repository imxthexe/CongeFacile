<?php

include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$data = [];
$errors = [];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    $requete = $connexion->prepare(
        'SELECT id, email, password
        FROM user
        WHERE email = :email
    ');
    

    $requete->bindParam('email', $data['email']);
    $requete->execute();
    $utilisateur = $requete->fetch(\PDO::FETCH_ASSOC);


    if ($utilisateur === false) {
        $erreurs['email'] = 'Compte non valide.';
    } else {
        if (password_verify($data['password'], $utilisateur['password'])) {

            $_SESSION['utilisateur'] = [
                'id' => $utilisateur['id'],
                'email' => $utilisateur['email']
            ];



            // On redirige l'utilisateur sur la page d'accueil.
            header('Location: index.php');
        } else {    
            // KO mot de passe incorrect
            $erreurs['email'] = 'Compte non valide.';
            echo "compte non valide";
        }
    }


    $RegexMail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    $data['email'] = trim($data['email']);
    $data['password'] = trim($data['password']);

    $data['email'] = htmlspecialchars($data['email']);
    $data['password'] = htmlspecialchars($data['password']);

    if (empty($data['email'])) {
        $errors['email'] = 'Veuillez renseigner votre email';
    } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Votre email est incorrect';
    } elseif (!preg_match($RegexMail, $data['email'])) {
        $errors['email'] = "Votre email est incorrect";
    }

    if (empty($data['password'])) {
        $errors['password'] = 'Veuillez saisir votre mot de passe.';
    }

}

?>