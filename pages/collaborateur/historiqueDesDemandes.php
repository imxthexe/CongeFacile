<?php
session_start();
$titre = 'Historique des demandes';
include '../../includes/database.php';
include '../../includes/functions.php';

$date   = [];
$errors = [];


var_dump($_SESSION['utilisateur']);
$idCollab = $_SESSION['utilisateur']['id'];

$requeteRecupRequest_type = $bdd->prepare("SELECT 
    r.id,
    rt.name AS request_type,
    r.start_at,
    r.end_at,
    r.created_at AS request_date,
    CASE 
        WHEN r.answer IS NULL THEN 'En cours'
        ELSE 'Validée'
    END AS status
FROM request r
JOIN person p ON r.collaborator_id = p.id
JOIN request_type rt ON r.request_type_id = rt.id;
WHERE r.collaborator_id = :id");
$requeteRecupRequest_type->bindParam(':id', $idCollab);
$requeteRecupRequest_type->execute();
$requetes = $requeteRecupRequest_type->fetchAll(PDO::FETCH_ASSOC);

// $requeteRecupRequest_type_name = $bdd->prepare('SELECT name FROM request_type WHERE id = :id');
// $requeteRecupRequest_type_name->bindParam(':id', $requetes['request_type_id']);
// $requete_name = $requeteRecupRequest_type_name->fetchAll(PDO::FETCH_ASSOC);


var_dump($requetes);


?>

<link rel="stylesheet" href="../../style.css">
<?php include "../../includes/header2.php"; ?>
<div class="flex">
    <?php include "../../includes/navBar/navBar1.php"; ?>
    <div class="containerHistoriqueUser page">
        <section class="historiqueUserSection">
            <div class="headerRow">
                <h2>Historique de mes demandes</h2>
            </div>
            <table class="mesDemandesTable">
                <thead>
                    <tr>
                        <th>Type de demande</th>
                        <th>Demandé le</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nb jours</th>
                        <th>Statut</th>
                    </tr>
                    <tr class="filtersRow">
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="date" /></th>
                        <th><input type="date" /></th>
                        <th><input type="number" /></th>
                        <th><input type="text" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($date)) {
                        foreach ($date as $row) {
                            echo "<tr>";
                            echo "<td data-label='Type de demande'>" . htmlspecialchars($row['request_type_name']) . "</td>";
                            echo "<td data-label='Demandé le'>" . htmlspecialchars($row['created_at']) . "</td>";
                            echo "<td data-label='Date de début'>" . htmlspecialchars($row['start_at']) . "</td>";
                            echo "<td data-label='Date de fin'>" . htmlspecialchars($row['end_at']) . "</td>";
                            echo "<td data-label='Nb jours'>" . $jours . "</td>";
                            echo "<td data-label='Statut'>" . htmlspecialchars($row['answer_comment']) . "</td>";
                            echo "<td><button class='detailsButton'>Détails</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Aucune donnée trouvée.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
</body>

</html>²