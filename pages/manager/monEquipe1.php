<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/verifSecuriteManager.php';

$querry = $bdd->prepare(
    "SELECT 
    p.last_name AS Nom,
    p.first_name AS Prénom,
    u.email AS Email,
    d.name AS Département,
    r.created_at AS Date_Demande
    FROM request r
    JOIN person p ON r.collaborator_id = p.id
    JOIN user u ON p.id = u.person_id
    JOIN department d ON p.department_id = d.id
    ORDER BY r.created_at DESC;

"
);

$querry->execute();
$managers = $querry->fetchAll(pdo::FETCH_ASSOC);


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
                    <?php if (!empty($managers)): ?>
                        <?php foreach ($managers as $manager): ?>


                            <tr>
                                <td data-label="Nom"> <?php echo htmlspecialchars($manager["Nom"]) ?></td>
                                <td data-label="Prénom"> <?php echo htmlspecialchars($manager["Prénom"]) ?></td>
                                <td data-label="Adresse email"> <?php echo htmlspecialchars($manager["Email"]) ?></td>
                                <td data-label="Poste"> <?php echo htmlspecialchars($manager["Département"]) ?></td>
                                <td data-label="Nb congés posés sur l'année"> <?php echo htmlspecialchars($manager["Date_Demande"]) ?></td>
                                <td><a href="monEquipe2.php"><button class="detailsButton">Détails</button></a></td>
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