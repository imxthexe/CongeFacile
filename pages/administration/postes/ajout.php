<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../../includes/database.php';
include '../../../includes/header3.php';
?>

<link rel="stylesheet" href="../../../style.css">

<div class="flex">
    <?php include "../../../includes/navBar/navBar1.php"; ?>

    <div class="containerajout page">
        <section class="ajout">

            <h1>Ajouter un nouveau poste </h1>

            <form class="editajoutForm">
                <label for="nomajoute">Nom du ajoute</label>
                <input type="text" id="nomajoute" name="nomajoute" value="Développeur Web" />

                <div class="actionButtons">
                    <button type="submit" class="updateBtn">Ajouter</button>
                </div>
            </form>
        </section>
    </div>
</div>
</body>

</html>