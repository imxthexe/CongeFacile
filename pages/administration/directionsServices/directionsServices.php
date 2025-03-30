<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../../includes/database.php';
include '../../../includes/header3.php';

?>

<link rel="stylesheet" href="../../../style.css">


<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerPost page">
        <section class="administration">

            <div class="headerRow">
                <h2>Directions/Services</h2>
                <button class="addPostButton">Ajouter une direction/service</button>
            </div>


            <table class="directionsTable">
                <thead>
                    <tr>
                        <th>Nom de la direction ou du service</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th>
                            <input type="text" placeholder="Rechercher une direction ou un service" />
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Nom de la direction ou du service">BU Symfony</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Nom de la direction ou du service">BU Wordpress</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Nom de la direction ou du service">BU Applications mobiles</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Nom de la direction ou du service">BU Marketing</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Nom de la direction ou du service">Autre</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>
</body>

</html>