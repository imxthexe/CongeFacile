<?php
session_start();
$titre = 'Details Type De Demande';
include '../../../includes/database.php';
include '../../../includes/header3.php';
include '../../../includes/functions.php';

$id = $_GET['id'];

$recupRequest_name = $bdd->prepare('SELECT name FROM request_type WHERE id = :id');
$recupRequest_name->bindParam('id', $id);
$recupRequest_name->execute();
$name = $recupRequest_name->fetch(pdo::FETCH_ASSOC);

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (empty($data['type'])) {
        $errors['type'] == 'Veuillez renseigner un nouveau type de congé';
    }
}
?>

<link rel="stylesheet" href="../../../style.css">

<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerAjoutDemande page">
        <section class="DemandesAjout">
            <h1>Types de demandes</h1>

            <form class="editTypeForm" method="post">
                <label for="nomType">Nom du type</label>
                <input type="text" name="type" placeholder="Congé ..." value="<?php echo $name['name'] ?>" required>
                <?php echo afficheErreur('type', $errors);  ?>
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
        if (confirm("Êtes-vous sûr de vouloir supprimer ce type de demande ? Cette action est irréversible.")) {
            window.location.href = "supprimerTypeDemande.php?id=" + id;
        }
    }
</script>
</body>

</html>