<?php

session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';

$querry = $bdd->prepare(
    "SELECT 
    p.id AS ID,
    p.last_name AS Nom,
    p.first_name AS Prénom,
    u.email AS Email,
    d.name AS Département,
    COALESCE(COUNT(r.id), 0) AS Nombre_Conge,
    m.id AS Manager_ID -- Récupérer l'ID du manager depuis la table person
FROM person p
JOIN user u ON p.id = u.person_id
JOIN department d ON p.department_id = d.id
LEFT JOIN request r ON p.id = r.collaborator_id 
    AND YEAR(r.start_at) = YEAR(CURDATE()) -- Filtrer sur l'année en cours
LEFT JOIN person m ON p.manager_id = m.id -- Joindre la table person pour récupérer l'ID du manager
WHERE p.department_id = (
    -- Récupérer le département du manager connecté
    SELECT pe.department_id
    FROM person pe
    JOIN user us ON pe.id = us.person_id
    WHERE us.id = :manager_user_id
)
GROUP BY p.id, p.last_name, p.first_name, u.email, d.name, m.id;

"
);
$querry->bindParam(':manager_user_id', $_SESSION['utilisateur']['id']);
$querry->execute();
$collabs = $querry->fetchAll(pdo::FETCH_ASSOC);


foreach ($collabs as $key => $collab) :
    if ($collab['Manager_ID'] == null) {
        unset($collabs[$key]);
    }
endforeach;




?>

<link rel="stylesheet" href="../../style.css" />

<div class="flex">
    <?php include "../../includes/navBar/navBar2.php"; ?>
    <div class="containerMonEquipe page">
        <section class="monEquipeSection">
            <div class="headerRow">
                <h2>Mon équipe</h2>
                <button class="addCollaboratorButton">Ajouter un collaborateur</button>
            </div>
            <table class="monEquipeTable">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse email</th>
                        <th>Poste</th>
                        <th>Nb congés posés sur l'année</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th><input type="text" /></th>
                        <th><input type="text" /></th>
                        <th><input type="mail" /></th>
                        <th><input type="text" /></th>
                        <th><input type="number" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($collabs)): ?>
                        <?php foreach ($collabs as $collab): $id = $collab['ID'] ?>


                            <tr>
                                <td data-label="Nom"> <?php echo htmlspecialchars($collab["Nom"]) ?></td>
                                <td data-label="Prénom"> <?php echo htmlspecialchars($collab["Prénom"]) ?></td>
                                <td data-label="Adresse email"> <?php echo htmlspecialchars($collab["Email"]) ?></td>
                                <td data-label="Poste"> <?php echo htmlspecialchars($collab["Département"]) ?></td>
                                <td data-label="Nb congés posés sur l'année"> <?php echo htmlspecialchars($collab["Nombre_Conge"]) ?></td>
                                <td><a href="monEquipe2.php?id=<?php echo $id  ?>"><button class="detailsButton">Détails</button></a></td>
                            </tr>

                        <?php endforeach; ?>
                    <?php endif; ?>


                </tbody>
            </table>
        </section>
    </div>
</div>
</body>

</html>