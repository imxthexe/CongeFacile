<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../includes/database.php';
include '../../includes/header2.php';

?>


<link rel="stylesheet" href="../../style.css">

<div class="flex">
    <?php include "../../includes/navBar/navBar2.php"; ?>
    <div class="containerHistorique page">
        <section class="historiqueSection">
            <div class="headerRow">
                <h2>Historique des demandes</h2>
            </div>
            <table class="historiqueTable">
                <thead>
                    <tr>
                        <th>Type de demande</th>
                        <th>Collaborateur</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nb jours</th>
                        <th>Statut</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th><input type="text" /></th>
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="date" /></th>
                        <th><input type="number" /></th>
                        <th><input type="text" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Type de demande">Congé sans solde</td>
                        <td data-label="Collaborateur">Lucas Dupas</td>
                        <td data-label="Date de début">03/01/2024 08:00</td>
                        <td data-label="Date de fin">10/01/2024 08:00</td>
                        <td data-label="Nb jours">0.5 jours</td>
                        <td data-label="Statut">Validé</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Type de demande">Congé payé</td>
                        <td data-label="Collaborateur">Jeff Martins</td>
                        <td data-label="Date de début">29/12/2023 08:00</td>
                        <td data-label="Date de fin">12/01/2024 08:00</td>
                        <td data-label="Nb jours">8 jours</td>
                        <td data-label="Statut">Validé</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Type de demande">Congé sans solde</td>
                        <td data-label="Collaborateur">Adrien Turcey</td>
                        <td data-label="Date de début">05/01/2024 08:00</td>
                        <td data-label="Date de fin">09/01/2024 08:00</td>
                        <td data-label="Nb jours">4 jours</td>
                        <td data-label="Statut">Refusé</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Type de demande">Congé maladie</td>
                        <td data-label="Collaborateur">Nicolas Verdier</td>
                        <td data-label="Date de début">10/01/2024 08:00</td>
                        <td data-label="Date de fin">15/01/2024 08:00</td>
                        <td data-label="Nb jours">0.5 jours</td>
                        <td data-label="Statut">Validé</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Type de demande">Congé sans solde</td>
                        <td data-label="Collaborateur">Jeff Martins</td>
                        <td data-label="Date de début">28/12/2023 08:00</td>
                        <td data-label="Date de fin">07/01/2024 08:00</td>
                        <td data-label="Nb jours">10 jours</td>
                        <td data-label="Statut">Validé</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
</div>
<?php include '../../includes/footer.php' ?>