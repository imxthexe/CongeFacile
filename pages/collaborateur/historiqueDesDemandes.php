<?php
session_start();
$titre = 'Historique des demandes';
include '../../includes/database.php';
include '../../includes/functions.php';
include '../../includes/verifSecuriteCollaborateur.php';

$idCollab = $_SESSION['utilisateur']['id'];

// Récupérer les filtres
$typeFiltre = isset($_GET['type']) ? trim($_GET['type']) : '';
$dateDemandeFiltre = isset($_GET['date_demande']) ? trim($_GET['date_demande']) : '';
$dateDebutFiltre = isset($_GET['date_debut']) ? trim($_GET['date_debut']) : '';
$dateFinFiltre = isset($_GET['date_fin']) ? trim($_GET['date_fin']) : '';
$nbJoursFiltre = isset($_GET['nb_jours']) ? trim($_GET['nb_jours']) : '';
$statutFiltre = isset($_GET['statut']) ? trim($_GET['statut']) : '';

// Construire la requête dynamique
$sql = "SELECT 
    r.id,
    rt.name AS request_type,
    r.start_at,
    r.end_at,
    r.created_at AS request_date,
    DATEDIFF(r.end_at, r.start_at) + 1 AS nb_jours,
    CASE 
        WHEN r.answer IS NULL THEN 'En cours'
        ELSE 'Validée'
    END AS status
FROM request r
JOIN person p ON r.collaborator_id = p.id
JOIN request_type rt ON r.request_type_id = rt.id
WHERE r.collaborator_id = :id";

$params = [':id' => $idCollab];

// Ajout des filtres
if (!empty($typeFiltre)) {
    $sql .= " AND rt.name LIKE :type";
    $params[':type'] = '%' . $typeFiltre . '%';
}
if (!empty($dateDemandeFiltre)) {
    $sql .= " AND DATE(r.created_at) = :dateDemande";
    $params[':dateDemande'] = $dateDemandeFiltre;
}
if (!empty($dateDebutFiltre)) {
    $sql .= " AND DATE(r.start_at) = :dateDebut";
    $params[':dateDebut'] = $dateDebutFiltre;
}
if (!empty($dateFinFiltre)) {
    $sql .= " AND DATE(r.end_at) = :dateFin";
    $params[':dateFin'] = $dateFinFiltre;
}
if (!empty($nbJoursFiltre)) {
    $sql .= " AND (DATEDIFF(r.end_at, r.start_at) + 1) = :nbJours";
    $params[':nbJours'] = $nbJoursFiltre;
}
if (!empty($statutFiltre)) {
    $sql .= " AND (CASE WHEN r.answer IS NULL THEN 'En cours' ELSE 'Validée' END) LIKE :statut";
    $params[':statut'] = '%' . $statutFiltre . '%';
}

// Préparation + exécution
$requeteRecupRequest_type = $bdd->prepare($sql);
$requeteRecupRequest_type->execute($params);
$requetes = $requeteRecupRequest_type->fetchAll(PDO::FETCH_ASSOC);

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
            <form method="get">
                <table class="mesDemandesTable">
                    <thead>
                        <tr>
                            <th>Type de demande</th>
                            <th>Demandé le</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Nb jours</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th><input type="text" name="type" value="<?= htmlspecialchars($typeFiltre) ?>" /></th>
                            <th><input type="date" name="date_demande" value="<?= htmlspecialchars($dateDemandeFiltre) ?>" /></th>
                            <th><input type="date" name="date_debut" value="<?= htmlspecialchars($dateDebutFiltre) ?>" /></th>
                            <th><input type="date" name="date_fin" value="<?= htmlspecialchars($dateFinFiltre) ?>" /></th>
                            <th><input type="number" name="nb_jours" value="<?= htmlspecialchars($nbJoursFiltre) ?>" /></th>
                            <th><input type="text" name="statut" value="<?= htmlspecialchars($statutFiltre) ?>" /></th>
                            <th><button type="submit">Filtrer</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($requetes)) {
                            foreach ($requetes as $requete) {
                                echo "<tr>";
                                echo "<td data-label='Type de demande'>" . htmlspecialchars($requete['request_type']) . "</td>";
                                echo "<td data-label='Demandé le'>" . htmlspecialchars(substr($requete['request_date'], 0, 10)) . "</td>";
                                echo "<td data-label='Date de début'>" . htmlspecialchars($requete['start_at']) . "</td>";
                                echo "<td data-label='Date de fin'>" . htmlspecialchars($requete['end_at']) . "</td>";
                                echo "<td data-label='Nb jours'>" . htmlspecialchars($requete['nb_jours']) . "</td>";
                                echo "<td data-label='Statut'>" . htmlspecialchars($requete['status']) . "</td>";
                                echo "<td><a href='../../pages/collaborateur/detailsDemande.php' class='detailsButton'>Détails</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Aucune donnée trouvée.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </section>
    </div>
</div>
</body>

</html>