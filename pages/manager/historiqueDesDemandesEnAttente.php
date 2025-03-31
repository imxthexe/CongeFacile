<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../includes/database.php';
include '../../includes/header2.php';


$recupRequetesCollab = $bdd->prepare("SELECT 
    col.last_name AS collaborator_last_name,
    col.first_name AS collaborator_first_name,
    rt.name AS request_type,
    req.created_at,
    req.start_at,
    req.end_at,
    CASE 
        WHEN req.answer IS NULL THEN 'En cours'
        WHEN req.answer = 0 THEN 'Refusé'
        WHEN req.answer = 1 THEN 'Validé'
        ELSE 'Statut inconnu' 
    END AS statut
FROM request req
JOIN request_type rt ON req.request_type_id = rt.id
JOIN person col ON req.collaborator_id = col.id

           ");

$recupRequetesCollab->execute();
$requetes = $recupRequetesCollab->fetchAll(pdo::FETCH_ASSOC);
?>


<link rel="stylesheet" href="../../style.css">

<div class="flex">
    <?php include "../../includes/navBar/navBar2.php"; ?>
    <div class="containerHistorique page">
        <section class="historiqueSection">
            <div class="headerRow">
                <h2>Historique des demandes</h2>
            </div>
            <table class="historiqueTable">
                <thead>
                    <tr>
                        <th>Type de demande</th>
                        <th>Collaborateur</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nb jours</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th><input type="text" /></th>
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="date" /></th>
                        <th><input type="number" /></th>
                        <th><input type="text" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($requetes)) {

                        foreach ($requetes as $requete) {

                            echo "<tr>";
                            echo "<td data-label='Type de demande'>" . htmlspecialchars($requete['request_type']) . "</td>";
                            echo "<td data-label='Nb jours'>"  . htmlspecialchars($requete['collaborator_first_name']) . ' ' . htmlspecialchars($requete['collaborator_last_name']) . "</td>";
                            echo "<td data-label='Date de début'>" . htmlspecialchars($requete['start_at']) . "</td>";
                            echo "<td data-label='Date de fin'>" . htmlspecialchars($requete['end_at']) . "</td>";
                            echo "<td data-label='Date de fin'>" . 'Ca arrrive' . "</td>";
                            echo "<td data-label='Demandé le'>" . htmlspecialchars($requete['statut']) . "</td>";
                            echo "<td><button class='detailsButton'>Détails</button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Aucune demande trouvée.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
<?php include '../../includes/footer.php' ?>