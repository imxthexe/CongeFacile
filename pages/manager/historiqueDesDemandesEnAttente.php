<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';

// Récupération des filtres
$typeFiltre = isset($_GET['type']) ? trim($_GET['type']) : '';
$collabFiltre = isset($_GET['collaborateur']) ? trim($_GET['collaborateur']) : '';
$dateDebutFiltre = isset($_GET['date_debut']) ? trim($_GET['date_debut']) : '';
$dateFinFiltre = isset($_GET['date_fin']) ? trim($_GET['date_fin']) : '';
$nbJoursFiltre = isset($_GET['nb_jours']) ? trim($_GET['nb_jours']) : '';
$statutFiltre = isset($_GET['statut']) ? trim($_GET['statut']) : '';

// Construction de la requête dynamique
$sql = "SELECT 
    col.last_name AS collaborator_last_name,
    col.first_name AS collaborator_first_name,
    rt.name AS request_type,
    req.created_at,
    req.start_at,
    req.end_at,
    DATEDIFF(req.end_at, req.start_at) + 1 AS nb_jours,
    CASE 
        WHEN req.answer IS NULL THEN 'En cours'
        WHEN req.answer = 0 THEN 'Refusé'
        WHEN req.answer = 1 THEN 'Validé'
        ELSE 'Statut inconnu' 
    END AS statut
FROM request req
JOIN request_type rt ON req.request_type_id = rt.id
JOIN person col ON req.collaborator_id = col.id
WHERE 1=1";

$params = [];

// Ajout des filtres
if (!empty($typeFiltre)) {
    $sql .= " AND rt.name LIKE :type";
    $params[':type'] = '%' . $typeFiltre . '%';
}
if (!empty($collabFiltre)) {
    $sql .= " AND (col.first_name LIKE :collab OR col.last_name LIKE :collab)";
    $params[':collab'] = '%' . $collabFiltre . '%';
}
if (!empty($dateDebutFiltre)) {
    $sql .= " AND DATE(req.start_at) = :dateDebut";
    $params[':dateDebut'] = $dateDebutFiltre;
}
if (!empty($dateFinFiltre)) {
    $sql .= " AND DATE(req.end_at) = :dateFin";
    $params[':dateFin'] = $dateFinFiltre;
}
if (!empty($nbJoursFiltre)) {
    $sql .= " AND (DATEDIFF(req.end_at, req.start_at) + 1) = :nbJours";
    $params[':nbJours'] = $nbJoursFiltre;
}
if (!empty($statutFiltre)) {
    $sql .= " AND (CASE 
        WHEN req.answer IS NULL THEN 'En cours'
        WHEN req.answer = 0 THEN 'Refusé'
        WHEN req.answer = 1 THEN 'Validé'
        ELSE 'Statut inconnu' 
    END) LIKE :statut";
    $params[':statut'] = '%' . $statutFiltre . '%';
}

// Exécution de la requête
$recupRequetesCollab = $bdd->prepare($sql);
$recupRequetesCollab->execute($params);
$requetes = $recupRequetesCollab->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../../style.css">

<div class="flex">
    <?php include "../../includes/navBar/navBar2.php"; ?>
    <div class="containerHistorique page">
        <section class="historiqueSection">
            <div class="headerRow">
                <h1>Historique des demandes</h1>
            </div>
            <form method="get">
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
                            <th><input type="text" name="type" value="<?= htmlspecialchars($typeFiltre) ?>" /></th>
                            <th><input type="text" name="collaborateur" value="<?= htmlspecialchars($collabFiltre) ?>" /></th>
                            <th><input type="date" name="date_debut" value="<?= htmlspecialchars($dateDebutFiltre) ?>" /></th>
                            <th><input type="date" name="date_fin" value="<?= htmlspecialchars($dateFinFiltre) ?>" /></th>
                            <th><input type="number" name="nb_jours" value="<?= htmlspecialchars($nbJoursFiltre) ?>" /></th>
                            <th><input type="text" name="statut" value="<?= htmlspecialchars($statutFiltre) ?>" /></th>
                            <th style="padding: 0 10px 0 0 ;"><button type="submit">Filtrer</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($requetes)) {
                            foreach ($requetes as $requete) {
                                echo "<tr>";
                                echo "<td data-label='Type de demande'>" . htmlspecialchars($requete['request_type']) . "</td>";
                                echo "<td data-label='Collaborateur'>" . htmlspecialchars($requete['collaborator_first_name']) . ' ' . htmlspecialchars($requete['collaborator_last_name']) . "</td>";
                                echo "<td data-label='Date de début'>" . htmlspecialchars($requete['start_at']) . "</td>";
                                echo "<td data-label='Date de fin'>" . htmlspecialchars($requete['end_at']) . "</td>";
                                echo "<td data-label='Nb jours'>" . htmlspecialchars($requete['nb_jours']) . "</td>";
                                echo "<td data-label='Statut'>" . htmlspecialchars($requete['statut']) . "</td>";
                                echo "<td><button class='detailsButton'>Détails</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Aucune demande trouvée.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </section>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>