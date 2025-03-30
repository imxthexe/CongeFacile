<?php session_start();  ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Directions/Services</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>
        .administration {
            padding: 20px;
            width: 75%;
        }

        .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 50px;
        }

        .headerRow h2 {
            margin: 0;
            font-size: 1.6rem;
            color: var(--color_title);
        }

        .addPostButton {
            background-color: var(--color_btn);
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 20px;
            width: 200px;
        }

        .addPostButton:hover {
            background-color: #1565C0;
        }

        .directionsTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }

        .directionsTable thead {
            background-color: var(--border);
        }

        .directionsTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }

        .directionsTable tbody tr {
            border-bottom: 1px solid #ccc;
        }

        .directionsTable tbody tr:last-child {
            border-bottom: none;
        }

        .directionsTable td {
            text-align: left;
            padding: 12px 16px;
            border: none;
        }

        .filtersRow input {
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9rem;
            width: 100%;
        }

        .detailsButton {
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .detailsButton:hover {
            background-color: #bbb;
        }

        @media screen and (max-width: 1080px) {
            .directionsTable thead {
                display: none;
            }

            .directionsTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }

            .directionsTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }

            .directionsTable tbody td::before {
                content: attr(data-label);
                font-weight: bold;
            }

            .addPostButton {
                width: 100%;
                margin-left: 0;
                margin-top: 10px;
            }

            .headerRow {
                display: block;
            }
        }
    </style>
</head>

<body>
    <?php include "../../../includes/header.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar2.php"; ?>

        <div class="containerPost">
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