<?php
$titre = 'Nouvelle demande';
include '../../includes/database.php';
include '../../includes/header2.php';




?>


<div class="flex">
    <?php include "../../includes/navBar/navBar1.php"; ?>

    <div class="containerDemandesAttente page">
        <section class="demandesAttenteSection">
            <div class="headerRow">
                <h2>Demandes en attente</h2>
            </div>

            <table class="demandesAttenteTable">
                <thead>
                    <tr>
                        <th>Type de demande</th>
                        <th>Demande le</th>
                        <th>Collaborateur</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nb jours</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="date" /></th>
                        <th><input type="number" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Type de demande">Congé sans solde</td>
                        <td data-label="Demande le">03/01/2024 08:00</td>
                        <td data-label="Collaborateur">Lucas Dupas</td>
                        <td data-label="Date de début">10/01/2024 08:00</td>
                        <td data-label="Date de fin">15/01/2024 08:00</td>
                        <td data-label="Nb jours">5 jours</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>

                </tbody>
            </table>
        </section>
    </div>
</div>

<?php

include '../../includes/footer.php';

?>