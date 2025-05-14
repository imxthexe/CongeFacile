<?php
session_start();
$titre = 'Details de ma demande';
include '../../includes/database.php';
include '../../includes/functions.php';
include '../../includes/verifSecuriteCollaborateur.php';

$id = $_GET['id'];

$recupInfosDemande = $bdd->prepare("SELECT 
    request.id,
    request.start_at,
    request.end_at,
    request.created_at,
    request.answer,
    request.answer_comment,
    request_type.name AS request_type
FROM 
    request
JOIN 
    request_type ON request.request_type_id = request_type.id
WHERE 
    request.id = :id;");

$recupInfosDemande->bindParam(":id", $id);
$recupInfosDemande->execute();
$infos = $recupInfosDemande->fetch(PDO::FETCH_ASSOC);


$date1 = new DateTime($infos['start_at']);
$date1 = $date1->format('d');

$date2 = new DateTime($infos['end_at']);
$date2 = $date2->format('d');

if ($infos["answer"] == null) {
    $infos["answer_comment"] == "votre manager laissera un message lorsque il aura répondu à votre requète";
}

$nb_jours = $date2 - $date1;


if ($infos['answer'] === null) {
    $infos['answer'] = "en cours";
    $statutClass = "statutEnCours";
} else if ($infos['answer'] == 0) {
    $infos['answer'] = "refusé";
    $statutClass = "statutRefuse";
} else {
    $infos["answer"] = "validé";
    $statutClass = "statutValide";
}

?>

<link rel="stylesheet" href="../../style.css">
<?php include "../../includes/header2.php"; ?>
<div class="flex">
    <?php include "../../includes/navBar/navBar1.php"; ?>
    <div class="page">
        <section class="maDemandeSection">

            <h1>Ma demande de congé</h1>

            <b>
                <p class="activeP">type de demande: <?php echo $infos["request_type"] ?></p>
            </b>

            <div class="parameter">
                <p>Demande du <?= $infos["created_at"] ?></p>
                <p>Période : <?= $infos['start_at'] . ' au ' . $infos['end_at'] ?></p>
                <p>Nombre de jours : <?= $nb_jours ?></p>
            </div>


            <p>Statut de la demande : <span class="<?= $statutClass ?>"><?= $infos['answer'] ?></span></p>

            <p class="comment">Commentaire du manager :</p>

            <textarea placeholder="<?php if (($infos["answer"] == 1 || $infos["answer"] == 0)) {
                                        echo $infos["answer_comment"];
                                    } else {
                                        echo "Votre manager laissera un message lors de la réponse à votre requète !";
                                    } ?>"></textarea>
            <button class="backButton"><a style="color: black;" href="historiqueDesDemandes.php">Retourner à la liste de mes demandes</a></button>
        </section>
    </div>
</div>
</body>

</html>