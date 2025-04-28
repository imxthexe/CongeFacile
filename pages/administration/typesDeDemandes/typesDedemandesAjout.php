<?php
session_start();
$titre = 'AJouter un type de demande';
include '../../../includes/database.php';
include '../../../includes/header3.php';
include '../../../includes/functions.php';

$data = [];
$errors = [];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $recupTypeDemandes = $bdd->prepare('SELECT name FROM request_type');
    $recupTypeDemandes->execute();
    $types = $recupTypeDemandes->fetchAll(PDO::FETCH_ASSOC);

    if (empty($data['type'])) {
        $errors['type'] = 'Veuillez renseigner un nouveau type de congé';
    }

    foreach ($types as $type) {
        if ($type['name'] == $data['type']) {
            $errors['type'] = "Ce type de demande existe déjà ";
        }
    }

    if (empty($errors)) {
        $nouveauType = $bdd->prepare('INSERT INTO request_type VALUES (0,:type)');
        $nouveauType->bindParam(':type', $data['type']);
        $nouveauType->execute();
        header('Location:typesDedemandes.php');
    }
}
?>

<link rel="stylesheet" href="../../../style.css">

<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerAjoutDemande page">
        <section class="DemandesAjout">
            <h1>Ajouter un type de demande</h1>

            <form class="editTypeForm" method="post">
                <label for="nomType">Nom du type</label>
                <input type="text" name="type" placeholder="Congé ..." value="<?php echo afficheValeur('type', $data); ?>" required>
                <?php echo afficheErreur('type', $errors);  ?>

                <div class="actionButtons">
                    <button type="submit" class="updateBtn">Ajouter</button>
                </div>
            </form>
        </section>
    </div>
</div>
</body>

</html>