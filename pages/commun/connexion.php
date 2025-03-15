<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../style.css">

</head>

<?php

include '../../includes/database.php';
include '../../includes/header2.php';


if ($REQUEST_METHOD = 'POST') {
    if (isset($data)) {
        $index = [];
        $index = $bdd->prepare("SELECT id FROM user ");
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

<body>
    <div class="flex">
        <?php include '../../includes/navBar/navBar3.php' ?>
        <div class="containerConnexion page">
            <div class="connexion">
                <h1>CongéFacile</h1>

                <p class="p_Connexion">
                    CongéFacile est votre nouvel outil dédié à la gestion des congés au sein de l’entreprise. <br>
                    Plus besoin d’échanges interminables ou de formulaires papier : en quelques clics, vous pouvez gérer <br> vos absences en toute transparence et simplicité.
                    Connectez-vous ci-dessous pour accéder à votre espace.
                </p>

                <h2>Connectez-vous</h2>

                <form action="" class="FormConnexion">

                    <div class="labelConnexion">Adresse Mail</div>
                    <div class="inputConnexion">
                        <div class="inputConnexionMail">
                            <input type="email" placeholder="****@mentalworks.fr" name="mail">
                        </div>
                    </div>

                    <div class="labelConnexion">Mot de passe</div>
                    <div class="inputConnexion">
                        <input type="password" name="password">
                    </div>

                    <input type="submit" value="Connexion au portail" class="inputConnexionSubmit">
                </form>

                <p>Vous avez oublié votre mot de passe ? <a href="motDePasseOublie.php">Cliquez ici</a> pour le réinitialiser.</p>
            </div>
        </div>
    </div>



</body>

</html>


<?php


include '../../includes/footer.php'

?>