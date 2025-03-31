<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';

$querry = $bdd->prepare("SELECT 
                        p.id, 
                        p.last_name, 
                        p.first_name, 
                        p.manager_id, 
                        d.name AS department_name, 
                        po.name AS position_name, 
                        p.alert_new_request, 
                        p.alert_on_answer, 
                        p.alert_before_vacation
                        FROM person p
                        LEFT JOIN department d ON p.department_id = d.id
                        LEFT JOIN position po ON p.position_id = po.id;
");

$querry->execute();
$Postes = $querry->fetchAll(pdo::FETCH_ASSOC);


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

                    <?php foreach ($managers as $manager): ?>


                        <tr>
                            <td data-label="Nom">Martins</td>
                            <td data-label="Prénom">Jeff</td>
                            <td data-label="Adresse email">j.martins@mentalworks.fr</td>
                            <td data-label="Poste">Directeur technique</td>
                            <td data-label="Nb congés posés sur l'année">12</td>
                            <td><a href="monEquipe2.php"><button class="detailsButton">Détails</button></a></td>
                        </tr>

                    <?php endforeach; ?>


                </tbody>
            </table>
        </section>
    </div>
</div>
</body>

</html>