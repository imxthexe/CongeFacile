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
var_dump($infos);
?>

<link rel="stylesheet" href="../../style.css">
<?php include "../../includes/header2.php"; ?>
<div class="flex">
    <?php include "../../includes/navBar/navBar1.php"; ?>
    <div class="page">
        <section class="maDemandeSection">

            <h2>Ma demande de congé</h2>

            <b>
                <p class="activeP">type de demande: <?php echo $infos["request_type"] ?></p>
            </b>

            <div class="parameter">
                <p>Demande du <?= $infos["created_at"] ?></p>
                <p>Période : <?= $infos['start_at'] . ' au ' . $infos['end_at'] ?></p>
                <p>Nombre de jours : 3 jours</p>
            </div>


            <p>Statut de la demande : <span class="statutValide">Validé</span></p>

            <p class="comment">Commentaire du manager :</p>

            <textarea placeholder="Bon temps de vacances à Mayrouge et surtout, n'oublie pas la carte postale !!!"></textarea>
            <button class="backButton"><a style="color: black;" href="historiqueDesDemandes.php">Retourner à la liste de mes demandes</a></button>
        </section>
    </div>
</div>
</body>

</html>