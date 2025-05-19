<?php
session_start();
$titre = 'Consulter une demande';
include '../../includes/database.php';
include '../../includes/verifSession.php';
include '../../includes/verifSecuriteManager.php';

$id = $_GET['id'];

$recupererInfos = $bdd->prepare("SELECT 
    p.first_name,
    p.last_name,
    r.created_at AS date_demande,
    r.start_at AS date_debut,
    r.end_at AS date_fin,
    r.period,
    rt.name AS type_conge,
    r.comment AS commentaire
FROM 
    request r
JOIN 
    person p ON r.collaborator_id = p.id
JOIN 
    request_type rt ON r.request_type_id = rt.id
WHERE 
    r.id = :request_id;");

$recupererInfos->bindParam(':request_id', $id);
$recupererInfos->execute();
$infosDemandes = $recupererInfos->fetch(pdo::FETCH_ASSOC);

$date = new DateTime($infosDemandes['date_demande']);
$dateFormat = $date->format('d/m/y');



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_demande'] ?? null;
    $action = $_POST['action'] ?? null;
    if (isset($_POST['answer_comment'])) {
        $answer_comment = $_POST['answer_comment'];
    }

    if ($id && in_array($action, ['valider', 'refuser'])) {
        $answer = $action === 'valider' ? 1 : 0;
        $answerAt = date("Y-m-d H:i:s");

        $requete = $bdd->prepare("UPDATE request SET answer_comment = :answer_comment, answer = :answer, answer_at = :answer_at  WHERE id = :id");
        $requete->bindParam(':answer', $answer, PDO::PARAM_INT);
        if (!empty($answer_comment)) {
            $requete->bindValue(':answer_comment', $answer_comment);
        } else {
            $requete->bindValue(':answer_comment', null, PDO::PARAM_NULL);
        }
        $requete->bindParam(':answer_at', $answerAt);
        $requete->bindParam(':id', $id, PDO::PARAM_INT);
        $requete->execute();

        header('Location:demandesEnAttente.php');
    }
}
?>

<link rel="stylesheet" href="../../style.css">

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('form-reponse');
        form.addEventListener('submit', function(e) {
            const button = e.submitter;
            const action = button.value;

            let message = '';
            if (action === 'valider') {
                message = "Êtes-vous sûr de vouloir valider cette demande ?";
            } else if (action === 'refuser') {
                message = "Êtes-vous sûr de vouloir refuser cette demande ?";
            }

            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
</script>

<body>
    <?php include "../../includes/header2.php"; ?>
    <div class="flex">
        <?php include "../../includes/navBar/navBar2.php"; ?>
        <div class="containerDemandeDetail page">
            <section class="demandeDetailSection">
                <h2>Demande de <?php echo $infosDemandes['first_name'] . ' ' . $infosDemandes['last_name'] ?></h2>
                <b>
                    <p class="activeP">Demande du <?= $dateFormat ?></p>
                </b>

                <div class="parameter">
                    <p>Période: <?= $infosDemandes['date_debut'] . ' au ' . $infosDemandes['date_fin'] ?></p>
                    <p>Type de demande: <?= $infosDemandes['type_conge'] ?></p>
                    <p>Nombre de jours: <?= $infosDemandes['period'] ?></p>
                </div>


                <p>Commentaire supplémentaire</p>
                <textarea class="commentField1" readonly placeholder="<?= $infosDemandes["commentaire"] ?>"></textarea>
                <button class=" justifyButton">Télécharger le justificatif</button>
                <h3>Répondre à la demande</h3>
                <form method="POST" id="form-reponse">
                    <p>Saisir un commentaire</p>
                    <input class="commentField2" name="answer_comment" type="text">

                    <input type="hidden" name="id_demande" value="<?= htmlspecialchars($id) ?>">

                    <div class="actionButtons">
                        <button type="submit" name="action" value="refuser" class="refuseButton">Refuser la demande</button>
                        <button type="submit" name="action" value="valider" class="validateButton">Valider la demande</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</body>

</html>