<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Historique des demandes</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        .containerHistorique {
            flex: 1;
            padding: 80px 0 0 50px;
        }
        .containerHistorique .historiqueSection {
            padding: 20px;
            width: 90%;
        }
        .containerHistorique .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .containerHistorique .headerRow h2 {
            margin: 0;
            font-size: 1.6rem;
            color: var(--color_title);
        }
        .containerHistorique .historiqueTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }
        .containerHistorique .historiqueTable thead {
            background-color: var(--border);
        }
        .containerHistorique .historiqueTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }
        /* Ligne des filtres */
        .containerHistorique .filtersRow th {
            padding: 8px 0 8px 16px;
        }
        .containerHistorique .filtersRow input {
            width: 90%;
            height: 30px; 
            padding: 0 8px; 
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .containerHistorique .historiqueTable tbody tr {
            border-bottom: 1px solid #ccc;
        }
        .containerHistorique .historiqueTable tbody tr:last-child {
            border-bottom: none;
        }
        /* Modification du padding à 20px 16px */
        .containerHistorique .historiqueTable td {
            text-align: left;
            padding: 20px 16px;
            border: none;
        }
        .containerHistorique .detailsButton {
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .containerHistorique .detailsButton:hover {
            background-color: #bbb;
        }
        @media screen and (max-width: 1080px) {
            .containerHistorique .historiqueTable thead {
                display: none;
            }
            .containerHistorique .historiqueTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }
            .containerHistorique .historiqueTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }
            .containerHistorique .historiqueTable tbody td::before {
                content: attr(data-label);
                font-weight: bold;
            }
        }
    </style>
</head>
<body>
    <?php include "../../includes/header2.php"; ?>
    <div class="flex">
        <?php include "../../includes/navBar/navBar1.php"; ?>
        <div class="containerHistorique">
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
</body>
</html>
