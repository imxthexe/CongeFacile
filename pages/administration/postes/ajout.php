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

    <div class="containerajout page">
        <section class="ajout">

            <h1>Ajouter un nouveau poste</h1>

            <form class="editajoutForm">
                <label for="nomajoute">Nom du poste</label>
                <input type="text" id="Poste" name="poste" placeholder="Développeur..." />

                <div class="actionButtons">
                    <button type="submit" class="updateBtn">Ajouter</button>
                </div>
            </form>
        </section>
    </div>
</div>
</body>

</html>