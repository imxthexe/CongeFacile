<?php

session_start();
$titre = 'Mon equipe';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';

$querry = $bdd->prepare(
    "SELECT 
        p.id AS ID,
        p.last_name AS Nom,
        p.first_name AS Prénom,
        u.email AS Email,
        pos.name AS Poste, 
        COALESCE(COUNT(r.id), 0) AS Nombre_Conge,
        m.id AS Manager_ID
    FROM person p
    JOIN user u ON p.id = u.person_id
    JOIN positions pos ON p.position_id = pos.id 
    LEFT JOIN request r ON p.id = r.collaborator_id 
        AND YEAR(r.start_at) = YEAR(CURDATE())
    LEFT JOIN person m ON p.manager_id = m.id
    WHERE p.department_id = (
        SELECT pe.department_id
        FROM person pe
        JOIN user us ON pe.id = us.person_id
        WHERE us.id = :manager_user_id
    )
    GROUP BY p.id, p.last_name, p.first_name, u.email, pos.name, m.id
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
                <button class="addCollaboratorButton"><a href="ajoutcollab.php">Ajouter un collaborateur</a></button>
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
                                <td data-label="Poste"> <?php echo htmlspecialchars($collab["Poste"]) ?></td>
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