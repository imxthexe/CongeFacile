<?php
session_start();
$titre = 'Nouvelle demande';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSession.php';
include '../../includes/verifSecuriteManager.php';

$recupRequetesCollab = $bdd->prepare("SELECT 
                col.last_name AS collaborator_last_name,
                col.first_name AS collaborator_first_name,
                rt.name AS request_type,
                req.created_at,
                req.start_at,
                req.end_at
            FROM request req
            JOIN request_type rt ON req.request_type_id = rt.id
            JOIN person col ON req.collaborator_id = col.id
            WHERE req.answer IS NULL");

$recupRequetesCollab->execute();
$requetes = $recupRequetesCollab->fetchAll(pdo::FETCH_ASSOC);
?>


<div class="flex">
    <?php include "../../includes/navBar/navBar2.php"; ?>

    <div class="containerDemandesAttente page">
        <section class="demandesAttenteSection">
            <div class="headerRow">
                <h1>Demandes en attente</h1>
            </div>

            <table class="demandesAttenteTable">
                <thead>
                    <tr>
                        <th>Type de demande</th>
                        <th>Demande le</th>
                        <th>Collaborateur</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nb jours</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="date" /></th>
                        <th><input type="number" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($requetes)) {
                        foreach ($requetes as $requete) {
                            echo "<tr>";
                            echo "<td data-label='Type de demande'>" . htmlspecialchars($requete['request_type']) . "</td>";
                            echo "<td data-label='Demandé le'>" . htmlspecialchars($requete['created_at']) . "</td>";
                            echo "<td data-label='Nb jours'>"  . htmlspecialchars($requete['collaborator_first_name']) . ' ' . htmlspecialchars($requete['collaborator_last_name']) . "</td>";
                            echo "<td data-label='Date de début'>" . htmlspecialchars($requete['start_at']) . "</td>";
                            echo "<td data-label='Date de fin'>" . htmlspecialchars($requete['end_at']) . "</td>";
                            echo "<td data-label='Date de fin'>" . 'Ca arrrive' . "</td>";
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
    <script src="../../script.js"></script>
</div>

<?php

include '../../includes/footer.php';


?>