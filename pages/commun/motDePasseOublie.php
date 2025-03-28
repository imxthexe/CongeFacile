<?php

$titre = "mot_de_passe oublié ";

include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = $_POST;

    $RegexMail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    $data['email'] = trim($data['email']);

    $data['email'] = htmlspecialchars($data['email']);

    if (empty($data['email'])) {
        $errors['email'] = 'Veuillez renseigner votre email';
    } elseif (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = 'Votre email est incorrect';
    } elseif (!preg_match($RegexMail, $data['email'])) {
        $errors['email'] = "Votre email est incorrect";
    }

    $email = $data['email'];

    if (empty($errors)) {
        $recupPerson_id = $bdd->prepare("SELECT person_id FROM user WHERE email = :email ");
        $recupPerson_id->bindParam(':email', $data['email']);
        $recupPerson_id->execute();
        $id = $recupPerson_id->fetch(PDO::FETCH_ASSOC);

        $RecupNomEtPrenom = $bdd->prepare("SELECT last_name, first_name FROM person WHERE id = :id");
        $RecupNomEtPrenom->bindParam(':id', $id['person_id']);
        $RecupNomEtPrenom->execute();
        $NomEtPrenom = $RecupNomEtPrenom->fetch(PDO::FETCH_ASSOC);
        $Prenom = $NomEtPrenom['first_name'];
        $Nom = $NomEtPrenom['last_name'];
    }

    if (empty($errors) && isset($Prenom) && isset($Nom)) {
        // FONCTION MAIL A REALISER
    }
}
?>

<div class="flex">
    <?php include '../../includes/navBar/navBar3.php' ?>
    <div class=" page">
        <div class="connexion">
            <h1>Mot de passe oublié</h1>

            <p>
                Renseignez votre adresse email dans le champ ci-dessous. <br> Vous recevrez par la suite un email avec un lien vous permettant de réinitialiser votre mot de passe.
            </p>
        </div>

        <form method="POST" class="FormMDPOublié">

            <div class="labelConnexion">Adresse Mail</div>
            <div class="inputConnexion">
                <div class="inputConnexionMail">
                    <input type="email" placeholder="****@mentalworks.fr" name="email" value="<?php echo afficheValeur('email', $data); ?>">
                </div>
                <?php echo afficheErreur('email', $errors);  ?>
            </div>


            <input style="font-size: 18px;" type="submit" value="Demander à réinitialiser mon mot de passe" class="submitMDP">
        </form>
        <p><a href="../commun/connexion.php">Cliquez ici</a> pour retourner à la page de connexion</p>
    </div>
</div>