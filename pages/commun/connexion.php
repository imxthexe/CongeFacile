<?php
$titre = "Connexion";
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$data = [];
$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

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

    if (empty($data['password'])) {
        $errors['password'] = 'Veuillez saisir votre mot de passe.';
    }


    $requete = $bdd->prepare(
        'SELECT id, email, password, role
        FROM user
        WHERE email = :email
    '
    );


    $requete->bindParam('email', $data['email']);
    $requete->execute();
    $utilisateur = $requete->fetch(\PDO::FETCH_ASSOC);
    if ($utilisateur === false) {
        $errors['email'] = 'Compte non valide.';
    } else {
        if (password_verify($data['password'], $utilisateur["password"])) {

            $_SESSION['utilisateur'] = [
                'id' => $utilisateur['id'],
                'email' => $utilisateur['email'],
                'role' => $utilisateur['role']
            ];


            if ($utilisateur['role'] == "manager") {
                header("Location:../manager/demandesEnAttente.php");
            } else if ($utilisateur['role'] == "collaborateur") {
                header("Location:accueil.php");
            }
        } else {
            $errors['password'] = 'mot de passe incorrect ';
        }
    }
}

?>


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

            <form method="POST" class="FormConnexion">

                <div class="labelConnexion">Adresse Mail</div>
                <div class="inputConnexion">
                    <div class="inputConnexionMail">
                        <input type="email" placeholder="****@mentalworks.fr" name="email" value="<?php echo afficheValeur('email', $data); ?>">
                    </div>
                    <?php echo afficheErreur('email', $errors);  ?>
                </div>

                <div class="labelConnexion">Mot de passe</div>
                <div class="inputConnexion">
                    <input type="password" name="password">
                    <?php echo afficheErreur('password', $errors); ?>
                </div>

                <input type="submit" value="Connexion au portail" class="inputConnexionSubmit">
            </form>

            <p>Vous avez oublié votre mot de passe ? <a href="motDePasseOublie.php">Cliquez ici</a> pour le réinitialiser.</p>
        </div>
    </div>
</div>



<?php


include '../../includes/footer.php'

?>