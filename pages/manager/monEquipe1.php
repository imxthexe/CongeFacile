<?php
session_start();
$titre = 'Mon équipe';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';

$managerUserId = $_SESSION['utilisateur']['id'];
$stmtMgr = $bdd->prepare("SELECT person_id FROM user WHERE id = :uid");
$stmtMgr->execute(['uid' => $managerUserId]);
$managerPersonId = (int) $stmtMgr->fetchColumn();

// Construction dynamique de la requête
$whereClauses = ["p.manager_id = :mgrId"];
$params = ['mgrId' => $managerPersonId];

if (!empty($_GET['nom'])) {
  $whereClauses[] = "p.last_name LIKE :nom";
  $params['nom'] = "%" . $_GET['nom'] . "%";
}
if (!empty($_GET['prenom'])) {
  $whereClauses[] = "p.first_name LIKE :prenom";
  $params['prenom'] = "%" . $_GET['prenom'] . "%";
}
if (!empty($_GET['email'])) {
  $whereClauses[] = "u.email LIKE :email";
  $params['email'] = "%" . $_GET['email'] . "%";
}
if (!empty($_GET['poste'])) {
  $whereClauses[] = "pos.name LIKE :poste";
  $params['poste'] = "%" . $_GET['poste'] . "%";
}

$whereSQL = implode(" AND ", $whereClauses);

$sql = "
    SELECT 
        p.id                AS ID,
        p.last_name         AS Nom,
        p.first_name        AS Prénom,
        u.email             AS Email,
        pos.name            AS Poste,
        COALESCE(COUNT(r.id), 0) AS Nb_congés
    FROM person p
    JOIN user u   ON p.id         = u.person_id
    JOIN positions pos ON p.position_id = pos.id 
    LEFT JOIN request r 
        ON p.id = r.collaborator_id 
       AND YEAR(r.start_at) = YEAR(CURDATE())
    WHERE $whereSQL
    GROUP BY p.id, p.last_name, p.first_name, u.email, pos.name
";

$querry = $bdd->prepare($sql);
$querry->execute($params);
$collabs = $querry->fetchAll(PDO::FETCH_ASSOC);

// Filtrage supplémentaire en PHP pour Nb_congés
if (isset($_GET['nb_conges']) && $_GET['nb_conges'] !== '') {
  $collabs = array_filter($collabs, function ($c) {
    return $c['Nb_congés'] == $_GET['nb_conges'];
  });
}
?>

<link rel="stylesheet" href="../../style.css" />

<div class="flex">
  <?php include "../../includes/navBar/navBar2.php"; ?>
  <div class="containerMonEquipe page">
    <section class="monEquipeSection">

      <div class="headerRow">
        <h2>Mon équipe</h2>
        <button class="addCollaboratorButton">
          <a href="ajoutcollab.php">Ajouter un collaborateur</a>
        </button>
      </div>

      <form method="get">
        <table class="monEquipeTable">
          <thead>
            <tr>
              <th>Nom</th>
              <th>Prénom</th>
              <th>Email</th>
              <th>Poste</th>
              <th>Nb congés posés</th>
              <th></th>
            </tr>
            <tr class="filtersRow">
              <th><input type="text" name="nom" placeholder="Filtrer…" value="<?= htmlspecialchars($_GET['nom'] ?? '') ?>" /></th>
              <th><input type="text" name="prenom" placeholder="Filtrer…" value="<?= htmlspecialchars($_GET['prenom'] ?? '') ?>" /></th>
              <th><input type="text" name="email" placeholder="Filtrer…" value="<?= htmlspecialchars($_GET['email'] ?? '') ?>" /></th>
              <th><input type="text" name="poste" placeholder="Filtrer…" value="<?= htmlspecialchars($_GET['poste'] ?? '') ?>" /></th>
              <th><input type="number" name="nb_conges" placeholder="Filtrer…" value="<?= htmlspecialchars($_GET['nb_conges'] ?? '') ?>" /></th>
              <th><button type="submit">Filtrer</button></th>
            </tr>
          </thead>
      </form>
      <tbody>
        <?php if (!empty($collabs)): ?>
          <?php foreach ($collabs as $collab): ?>
            <tr>
              <td data-label="Nom"> <?= htmlspecialchars($collab['Nom']) ?></td>
              <td data-label="Prénom"> <?= htmlspecialchars($collab['Prénom']) ?></td>
              <td data-label="Email"> <?= htmlspecialchars($collab['Email']) ?></td>
              <td data-label="Poste"> <?= htmlspecialchars($collab['Poste']) ?></td>
              <td data-label="Nb congés"> <?= htmlspecialchars($collab['Nb_congés']) ?></td>
              <td>
                <a href="monEquipe2.php?id=<?= $collab['ID'] ?>">
                  <button class="detailsButton">Détails</button>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="6" style="text-align:center; padding:1em;">
              Aucun collaborateur assigné.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
      </table>

    </section>
  </div>
</div>
</body>

</html>