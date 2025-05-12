<?php
session_start();
$titre = 'Modifier un poste';
include '../../../includes/database.php';
include '../../../includes/header3.php';
include '../../../includes/functions.php';

$id = $_GET['id'];

$recupRequest_name = $bdd->prepare('SELECT name FROM department WHERE id = :id');
$recupRequest_name->bindParam(':id', $id);
$recupRequest_name->execute();
$name = $recupRequest_name->fetch(pdo::FETCH_ASSOC);

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    if (empty($data['poste'])) {
        $errors['poste'] = 'Veuillez renseigner le nouveau nom de ce poste';
    } else if ($data['poste'] == $name['name']) {
        $errors['poste'] = 'Veuillez changer le nom pour le modifier';
    }


    if (empty($errors)) {
        $ModifNomPoste = $bdd->prepare("UPDATE department
        SET name = :nom
        WHERE id = :id");
        $ModifNomPoste->bindValue(':nom', $data['poste']);
        $ModifNomPoste->bindValue(':id', $id);
        $ModifNomPoste->execute();
        header('Location: postes.php');
    }
}


?>

<link rel="stylesheet" href="../../../style.css">

<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerAjoutDemande page">
        <section class="DemandesAjout">
            <h1><?php echo $name['name'] ?></h1>

            <form class="editTypeForm" method="post">
                <label for="nomType">Nom du type</label>
                <input type="text" name="poste" placeholder="Congé ..." value="<?php echo $name['name'] ?>" required>
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
        if (confirm("Êtes-vous sûr de vouloir supprimer ce poste ? Cette action est irréversible.")) {
            window.location.href = "supprimerPoste.php?id=" + id;
        }
    }
</script>
</body>

</html>