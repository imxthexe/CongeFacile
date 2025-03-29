<?php

include '../../includes/database.php';
include '../../includes/header2.php';
include '../../includes/functions.php';

$date   = [];
$errors = [];












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
        <div class="containerHistoriqueUser page">
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
                        <?php
                        // Affichage des données stockées dans le tableau $date
                        if (!empty($date)) {
                            foreach ($date as $row) {
                                // Calcul du libellé "jour(s)" en fonction du nombre de jours
                                $jours = htmlspecialchars($row['nb_days']);
                                $jours .= ($jours > 1) ? " jours" : " jour";


                                echo "<tr>";
                                echo "<td data-label='Type de demande'>" . htmlspecialchars($row['request_type_name']) . "</td>";
                                echo "<td data-label='Demandé le'>" . htmlspecialchars($row['created_at']) . "</td>";
                                echo "<td data-label='Date de début'>" . htmlspecialchars($row['start_at']) . "</td>";
                                echo "<td data-label='Date de fin'>" . htmlspecialchars($row['end_at']) . "</td>";
                                echo "<td data-label='Nb jours'>" . $jours . "</td>";
                                echo "<td data-label='Statut'>" . htmlspecialchars($row['answer_comment']) . "</td>";
                                echo "<td><button class='detailsButton'>Détails</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Aucune donnée trouvée.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>

</html>²