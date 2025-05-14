<?php
session_start();
$titre = 'Demandes en attente';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSession.php';
include '../../includes/verifSecuriteManager.php';

// Construction dynamique des filtres
$conditions = ["req.answer IS NULL"];
$params = [];

if (!empty($_GET['type'])) {
    $conditions[] = "rt.name LIKE :type";
    $params['type'] = "%" . $_GET['type'] . "%";
}
if (!empty($_GET['date_demande'])) {
    $conditions[] = "DATE(req.created_at) = :date_demande";
    $params['date_demande'] = $_GET['date_demande'];
}
if (!empty($_GET['collaborateur'])) {
    $conditions[] = "(col.first_name LIKE :collab OR col.last_name LIKE :collab)";
    $params['collab'] = "%" . $_GET['collaborateur'] . "%";
}
if (!empty($_GET['date_debut'])) {
    $conditions[] = "DATE(req.start_at) = :start_at";
    $params['start_at'] = $_GET['date_debut'];
}
if (!empty($_GET['date_fin'])) {
    $conditions[] = "DATE(req.end_at) = :end_at";
    $params['end_at'] = $_GET['date_fin'];
}

$conditionSQL = implode(" AND ", $conditions);

$recupRequetesCollab = $bdd->prepare("
    SELECT 
        col.last_name AS collaborator_last_name,
        col.first_name AS collaborator_first_name,
        rt.name AS request_type,
        req.created_at,
        req.start_at,
        req.end_at
    FROM request req
    JOIN request_type rt ON req.request_type_id = rt.id
    JOIN person col ON req.collaborator_id = col.id
    WHERE $conditionSQL
");

$recupRequetesCollab->execute($params);
$requetes = $recupRequetesCollab->fetchAll(PDO::FETCH_ASSOC);

// Calcul Nb jours
foreach ($requetes as &$req) {
    $start = new DateTime($req['start_at']);
    $end = new DateTime($req['end_at']);
    $req['nb_jours'] = $start->diff($end)->days + 1;
}
?>

<div class="flex">
    <?php include "../../includes/navBar/navBar2.php"; ?>
    <div class="containerDemandesAttente page">
        <section class="demandesAttenteSection">
            <div class="headerRow">
                <h1>Demandes en attente</h1>
            </div>

            <form method="get">
                <table class="demandesAttenteTable">
                    <thead>
                        <tr>
                            <th>Type de demande</th>
                            <th>Demandé le</th>
                            <th>Collaborateur</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Nb jours</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th><input type="search" name="type" placeholder="Filtrer…" value="<?= htmlspecialchars($_GET['type'] ?? '') ?>" /></th>
                            <th><input type="date" name="date_demande" value="<?= htmlspecialchars($_GET['date_demande'] ?? '') ?>" /></th>
                            <th><input type="search" name="collaborateur" placeholder="Filtrer…" value="<?= htmlspecialchars($_GET['collaborateur'] ?? '') ?>" /></th>
                            <th><input type="date" name="date_debut" value="<?= htmlspecialchars($_GET['date_debut'] ?? '') ?>" /></th>
                            <th><input type="date" name="date_fin" value="<?= htmlspecialchars($_GET['date_fin'] ?? '') ?>" /></th>
                            <th><input type="number" name="nb_jours" placeholder="Filtrer…" value="<?= htmlspecialchars($_GET['nb_jours'] ?? '') ?>" /></th>
                            <th><button type="submit">Filtrer</button></th>
                        </tr>
                    </thead>
            </form>
            <tbody>
                <?php
                if (!empty($requetes)) {
                    foreach ($requetes as $requete) {
                        if (
                            isset($_GET['nb_jours']) &&
                            $_GET['nb_jours'] !== '' &&
                            $requete['nb_jours'] != $_GET['nb_jours']
                        ) {
                            continue;
                        }

                        echo "<tr>";
                        echo "<td data-label='Type de demande'>" . htmlspecialchars($requete['request_type']) . "</td>";
                        echo "<td data-label='Demandé le'>" . htmlspecialchars($requete['created_at']) . "</td>";
                        echo "<td data-label='Collaborateur'>"  . htmlspecialchars($requete['collaborator_first_name']) . ' ' . htmlspecialchars($requete['collaborator_last_name']) . "</td>";
                        echo "<td data-label='Date de début'>" . htmlspecialchars($requete['start_at']) . "</td>";
                        echo "<td data-label='Date de fin'>" . htmlspecialchars($requete['end_at']) . "</td>";
                        echo "<td data-label='Nb de jours'>" . htmlspecialchars($requete['nb_jours']) . "</td>";
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

<?php include '../../includes/footer.php'; ?>