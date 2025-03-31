<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../../includes/database.php';
include '../../../includes/header3.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (empty($data['type'])) {
        $errors['type'] == 'Veuillez renseigner un nouveau type de congé';
    }

    if (empty($errors)) {
        $nouveauType = $bdd->prepare('INSERT INTO departement VALUES (0,:poste)');
        $nouveauType->bindParam(':type', $data['poste']);
        $nouveauType->execute();
        header('Location:postes.php');
    }
}

?>


<link rel="stylesheet" href="../../../style.css">


    <div class="flex">
        <?php include "../../../includes/navBar/navBar3.php"; ?>

        <div class="containerManagerDetail page">
            <section class="managerDetail">
                <h2>Salesse Frédéric</h2>

                <form class="managerEditForm">
                    <label for="managerEmail">Adresse email - champ obligatoire</label>
                    <input
                        type="email"
                        id="managerEmail"
                        name="managerEmail"
                        value="salesse@mentalworks.fr"
                        required />

                    <div class="inlineFields">
                        <div class="fieldGroup">
                            <label for="managerLastName">Nom de famille - champ obligatoire</label>
                            <input
                                type="text"
                                id="managerLastName"
                                name="managerLastName"
                                value="Salesse"
                                required />
                        </div>
                        <div class="fieldGroup">
                            <label for="managerFirstName">Prénom - champ obligatoire</label>
                            <input
                                type="text"
                                id="managerFirstName"
                                name="managerFirstName"
                                value="Frédéric"
                                required />
                        </div>
                    </div>

                    <label for="managerDirection">Direction/Service - champ obligatoire</label>
                    <input
                        type="text"
                        id="managerDirection"
                        name="managerDirection"
                        value="BU Symfony"
                        required />

                    <div class="inlineFields">
                        <div class="fieldGroup">
                            <label for="managerNewPassword">Nouveau mot de passe</label>
                            <input
                                type="password"
                                id="managerNewPassword"
                                name="managerNewPassword" />
                        </div>
                        <div class="fieldGroup">
                            <label for="managerConfirmPassword">Confirmation de mot de passe</label>
                            <input
                                type="password"
                                id="managerConfirmPassword"
                                name="managerConfirmPassword" />
                        </div>
                    </div>

                    <button type="submit" class="managerUpdateBtn">Mettre à jour</button>
                </form>
            </section>
        </div>
    </div>
</body>

</html>