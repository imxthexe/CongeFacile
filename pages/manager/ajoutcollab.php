<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$data = [];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;

    $recupPostes = $bdd->prepare('SELECT name FROM department');
    $recupPostes->execute();
    $Postes = $recupPostes->fetchAll(PDO::FETCH_ASSOC);

    foreach ($Postes as $Poste) {
        if ($Poste['name'] == $data['poste']) {
            $errors['poste'] = 'Ce poste existe déja';
        }
    }

    if (empty($data['poste'])) {
        $errors['poste'] = 'Veuillez renseigner un nouveau type de congé';
    }

    if (empty($errors)) {
        $nouveauType = $bdd->prepare('INSERT INTO department VALUES (0,:poste)');
        $nouveauType->bindParam(':poste', $data['poste']);
        $nouveauType->execute();
        header('Location:postes.php');
    }
}

?>

<link rel="stylesheet" href="../../style.css">

<div class="flex">
    <?php include "../../includes/navBar/navBar3.php"; ?>

    <div class="containerajout page">
        <section class="ajout">

            <h1>Ajouter un nouveau collaborateur</h1>

            <form class="editajoutForm" method="POST">
                <label for="nomajoute">Nom du collaborateur</label>
                <input type="text" id="Poste" name="poste" placeholder="Développeur..." value="<?php echo afficheValeur('poste', $data) ?>" />
                <?php echo afficheErreur('poste', $errors); ?>

                <div class="actionButtons">
                    <button type="submit" class="updateBtn">Ajouter</button>
                </div>
            </form>
        </section>
    </div>
</div>
</body>

</html>