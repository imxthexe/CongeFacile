<?php 

include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$data = [];
$errors = [];

$requete = $connexion->prepare(
    'SELECT id, request_type, manager_id, created_at, start_at, end_at
    FROM user
    WHERE email = :email
');












?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique de mes demandes</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        .containerHistoriqueUser {
            flex: 1;
            padding: 80px 0 0 50px;
        }
        .containerHistoriqueUser .historiqueUserSection {
            padding: 20px;
            width: 90%;
        }
        .containerHistoriqueUser .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .containerHistoriqueUser .headerRow h2 {
            margin: 0;
            font-size: 1.6rem;
            color: var(--color_title);
        }
        .containerHistoriqueUser .mesDemandesTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }
        .containerHistoriqueUser .mesDemandesTable thead {
            background-color: var(--border);
        }
        .containerHistoriqueUser .mesDemandesTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }
        /* Ligne des filtres */
        .containerHistoriqueUser .filtersRow th {
            padding: 8px 0 8px 16px;
        }
        .containerHistoriqueUser .filtersRow input {
            width: 90%;
            height: 30px;
            padding: 0 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .containerHistoriqueUser .mesDemandesTable tbody tr {
            border-bottom: 1px solid #ccc;
        }
        .containerHistoriqueUser .mesDemandesTable tbody tr:last-child {
            border-bottom: none;
        }
        .containerHistoriqueUser .mesDemandesTable td {
            text-align: left;
            padding: 20px 16px;
            border: none;
        }
        .containerHistoriqueUser .detailsButton {
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .containerHistoriqueUser .detailsButton:hover {
            background-color: #bbb;
        }
        @media screen and (max-width: 1080px) {
            .containerHistoriqueUser .mesDemandesTable thead {
                display: none;
            }
            .containerHistoriqueUser .mesDemandesTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }
            .containerHistoriqueUser .mesDemandesTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }
            .containerHistoriqueUser .mesDemandesTable tbody td::before {
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
        <div class="containerHistoriqueUser">
            <section class="historiqueUserSection">
                <div class="headerRow">
                    <h2>Historique de mes demandes</h2>
                </div>
                <table class="mesDemandesTable">
                    <thead>
                        <tr>
                            <th>Type de demande</th>
                            <th>Demandé le</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Nb jours</th>
                            <th>Statut</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th><input type="text" /></th>
                            <th><input type="date" /></th>
                            <th><input type="date" /></th>
                            <th><input type="date" /></th>
                            <th><input type="number" /></th>
                            <th><input type="text" /></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Type de demande">Congé payé</td>
                            <td data-label="Demandé le">10/11/2024 10:00</td>
                            <td data-label="Date de début">10/12/2024 08:00</td>
                            <td data-label="Date de fin">12/12/2024 08:00</td>
                            <td data-label="Nb jours">3 jours</td>
                            <td data-label="Statut">Accepté</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Type de demande">Congé maladie</td>
                            <td data-label="Demandé le">08/12/2024 08:00</td>
                            <td data-label="Date de début">09/12/2024 08:00</td>
                            <td data-label="Date de fin">10/12/2024 08:00</td>
                            <td data-label="Nb jours">2 jours</td>
                            <td data-label="Statut">En cours</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Type de demande">Congé sans solde</td>
                            <td data-label="Demandé le">05/09/2024 10:00</td>
                            <td data-label="Date de début">08/09/2024 08:00</td>
                            <td data-label="Date de fin">10/09/2024 08:00</td>
                            <td data-label="Nb jours">2 jours</td>
                            <td data-label="Statut">Accepté</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
