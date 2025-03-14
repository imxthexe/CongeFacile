<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../style.css">

</head>

<body>

    <div class="container">
        <div class="connexion">
            <h1>CongéFacile</h1>

            <p>
                CongéFacile est votre nouvel outil dédié à la gestion des congés au sein de l’entreprise.
                Plus besoin d’échanges interminables ou de formulaires papier : en quelques clics, vous pouvez gérer vos absences en toute transparence et simplicité.
                Connectez-vous ci-dessous pour accéder à votre espace.
            </p>

            <h2>Connectez-vous</h2>

            <form action="">
                <label for="mail">Adresse Mail</label>
                <input type="mail" placeholder="****@mentalworks.fr">

                <label for="password">Mot de passe</label>
                <input type="password">

                <input type="submit" value="Connexion au portal">
            </form>

            <p>Vous avez oublié votre mot de passe ? <a href="">Cliquez ici</a> pour le réinitialiser.</p>



        </div>
    </div>


</body>

</html>


<?php

if ($REQUEST_METHOD = 'POST') {
    if (isset($data)) {
        $data = [];
        $password = [];
        $errors = [];
        $data = $_POST;

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

        $password = $data['password'];
        password_hash($password, PASSWORD_DEFAULT);

        $requete = $bdd->prepare("INSERT INTO user VALUES (:email, :password");
        $requete->execute(
            array(
                "email" => $data['email'],
                "password" => $password
            )
        );
    }
}


?>