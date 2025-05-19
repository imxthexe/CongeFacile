<?php
session_start();
$titre = 'Details de ma demande';
include '../../includes/database.php';
include '../../includes/functions.php';
include '../../includes/verifSecuriteManager.php';

$id = $_GET['id'];

$recupInfosDemande = $bdd->prepare("SELECT 
    col.last_name AS nom,
    col.first_name AS prenom,
    rt.name AS request_type,
    req.id,
    req.created_at,
    req.start_at,
    req.end_at,
    req.period,
    req.answer,
    req.answer_comment
FROM request req
JOIN person col ON req.collaborator_id = col.id
JOIN request_type rt ON req.request_type_id = rt.id
WHERE req.id = :id;");

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
    <?php include "../../includes/navBar/navBar2.php"; ?>
    <div class="page">
        <section class="maDemandeSection">

            <h1>Demande de <?php echo $infos['prenom'] . ' ' . $infos['nom'] ?></h1>

            <b>
                <p class="activeP">Type de demande : <?php echo $infos["request_type"] ?></p>
            </b>

            <div class="parameter">
                <p>Demande du <?= $infos["created_at"] ?></p>
                <p>Période : <?= $infos['start_at'] . ' au ' . $infos['end_at'] ?></p>
                <p>Nombre de jours : <?= $infos['period'] ?></p>
            </div>


            <p>Statut de la demande : <span class="<?= $statutClass ?>"><?= $infos['answer'] ?></span></p>

            <p class="comment">Commentaire du manager :</p>

            <textarea readonly placeholder="<?= htmlspecialchars($infos['answer_comment'] ?? "Vous n'avez pas laissé de commentaire") ?>"></textarea>
            <button class="backButton"><a style="color: black;" href="historiqueDesDemandesEnAttente.php">Retourner à la liste de mes demandes</a></button>
        </section>
    </div>
</div>
</body>

</html>