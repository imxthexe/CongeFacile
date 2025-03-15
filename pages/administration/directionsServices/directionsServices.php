<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>services - Directions/Services</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>
        /* Même logique que tes autres pages de type "Serviceses" ou "Types de demandes" */

        .directionServiceContainer {
            flex: 1;
            padding: 150px 0 0 50px;
        }

        .directionServiceContainer .services {
            padding: 20px;
            width: 65%;
        }

        /* Titre + bouton dans la même rangée */
        .directionServiceContainer .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .directionServiceContainer .headerRow h2 {
            margin: 0;
            padding: 0;
            font-size: 1.6rem;
            color: var(--color_title);
        }
        .directionServiceContainer .addServicesButton {
            background-color: var(--color_btn);
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 20px;
            width: 200px; /* Ajuste la largeur si besoin */
        }
        .directionServiceContainer .addServicesButton:hover {
            background-color: #1565C0;
        }

        /* Tableau principal */
        .directionServiceContainer .directionsTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }
        .directionServiceContainer .directionsTable thead {
            background-color: var(--border);
        }
        .directionServiceContainer .directionsTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }

        /* Séparation horizontale entre chaque ligne du tbody */
        .directionServiceContainer .directionsTable tbody tr {
            border-bottom: 1px solid #ccc;
        }
        .directionServiceContainer .directionsTable tbody tr:last-child {
            border-bottom: none;
        }

        .directionServiceContainer .directionsTable td {
            text-align: left;
            padding: 12px 16px;
            border: none;
        }

        /* Ligne de filtres dans le thead */
        .directionServiceContainer .filtersRow input {
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9rem;
            width: 100%;
            height: 35px;
        }

        /* Bouton Détails */
        .directionServiceContainer .detailsButton {
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .directionServiceContainer .detailsButton:hover {
            background-color: #bbb;
        }

        /* Responsive */
        @media screen and (max-width: 1080px) {
            .directionServiceContainer .directionsTable thead {
                display: none;
            }
            .directionServiceContainer .directionsTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }
            .directionServiceContainer .directionsTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }
            .directionServiceContainer .directionsTable tbody td::before {
                content: attr(data-label);
                font-weight: bold;
            }

            .directionServiceContainer .addServicesButton {
                width: 100%;
                margin-left: 0;
                margin-top: 10px;
            }
            .directionServiceContainer .headerRow {
                display: block;
            }
        }
    </style>
</head>
<body>
    <?php include "../../../includes/header.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar1.php"; ?>

        <div class="directionServiceContainer">
            <section class="services">
                <!-- Titre + bouton d'ajout -->
                <div class="headerRow">
                    <h2>Directions/Services</h2>
                    <button class="addServicesButton">Ajouter une direction/service</button>
                </div>

                <!-- Tableau -->
                <table class="directionsTable">
                    <thead>
                        <tr>
                            <th>Nom de la direction ou du service</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th>
                                <input type="text"/>
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
