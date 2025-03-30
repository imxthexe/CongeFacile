<?php
session_start();
$titre = 'Mes informations';
include '../../includes/database.php';
include '../../includes/header2.php';

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
                    <tr>
                        <td data-label="Nom">Martins</td>
                        <td data-label="Prénom">Jeff</td>
                        <td data-label="Adresse email">j.martins@mentalworks.fr</td>
                        <td data-label="Poste">Directeur technique</td>
                        <td data-label="Nb congés posés sur l'année">12</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Nom">Turcey</td>
                        <td data-label="Prénom">Adrien</td>
                        <td data-label="Adresse email">a.turcey@mentalworks.fr</td>
                        <td data-label="Poste">Lead Développeur</td>
                        <td data-label="Nb congés posés sur l'année">8</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Nom">Beharien</td>
                        <td data-label="Prénom">Matthieu</td>
                        <td data-label="Adresse email">m.beharien@mentalworks.fr</td>
                        <td data-label="Poste">Développeur Web</td>
                        <td data-label="Nb congés posés sur l'année">4</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Nom">Rivien</td>
                        <td data-label="Prénom">Mathias</td>
                        <td data-label="Adresse email">m.rivien@mentalworks.fr</td>
                        <td data-label="Poste">Développeur Web</td>
                        <td data-label="Nb congés posés sur l'année">3</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Nom">Dupas</td>
                        <td data-label="Prénom">Lucas</td>
                        <td data-label="Adresse email">l.dupas@mentalworks.fr</td>
                        <td data-label="Poste">Test</td>
                        <td data-label="Nb congés posés sur l'année">5</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>
</body>

</html>