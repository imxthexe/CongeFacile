<?php
session_start();
$titre = 'Details Type De Demande';
include '../../../includes/database.php';
include '../../../includes/header3.php';
include '../../../includes/functions.php';

$id = $_GET['id'];

$recupService = $bdd->prepare('SELECT name FROM department WHERE id = :id');
$recupService->bindParam(':id', $id);
$recupService->execute();
$Poste = $recupService->fetch(pdo::FETCH_ASSOC);

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (empty($data['poste'])) {
        $errors['poste'] = 'Veuillez renseigner le nouveau nom de ce département';
    } else if ($data['poste'] == $Poste['name']) {
        $errors['poste'] = 'Veuillez changer le nom pour le modifier';
    }


    if (empty($errors)) {
        $ModifNomPoste = $bdd->prepare("UPDATE department
        SET name = :nom
        WHERE id = :id");
        $ModifNomPoste->bindValue(':nom', $data['poste']);
        $ModifNomPoste->bindValue(':id', $id);
        $ModifNomPoste->execute();
        header('Location: directionsServices.php');
    }
}


?>

<link rel="stylesheet" href="../../../style.css">

<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerAjoutDemande page">
        <section class="DemandesAjout">
            <h1><?php echo $Poste['name'] ?></h1>

            <form class="editTypeForm" method="post">
                <label for="nomType">Nom du type</label>
                <input type="text" name="poste" placeholder="Congé ..." value="<?php echo $Poste['name'] ?>" required>
                <?php echo afficheErreur('poste', $errors);  ?>
                <div class="actionButtons">
                    <button type="button" class="deleteBtn" onclick="confirmDelete(<?php echo $id ?>)">Supprimer</button>
                    <button type="submit" class="updateBtn">Mettre à jour</button>
                </div>
            </form>
        </section>
    </div>
</div>
<script>
    function confirmDelete(id) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce département ? Cette action est irréversible.")) {
            window.location.href = "supprimerPoste.php?id=" + id;
        }
    }
</script>
</body>

</html>