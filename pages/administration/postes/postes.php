<!-- IL MANQUE LE BURGER MENU, QUAND IL PASSE EN RESPONSIVE FAUT CHANGER LE NAV BAR POUR S'ADPATER ET NORMALEMENT FINI-->
<!-- TOUJOURS LE PROBLEME DE HEADER QUI CASSE LES COUILLES -->
<!-- JE COMPREND PAS LE STYLE NE FONCITONE QUE DANS LE FICHIER DIRECT, LE LINK STYLESHEET NE FONCITONNE -->
<?php

session_start();

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postes</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>
        .containerPost {
            padding-right: 30px;
        }

        .containerPost .postes .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 50px;
        }

        .containerPost .postes .headerRow h2 {
            margin: 0;
            font-size: 1.6rem;
            color: var(--color_title);
        }

        .containerPost .postes .addPostButton {
            background-color: var(--color_btn);
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 20px;
            width: 150px;
        }

        .containerPost .postes .addPostButton:hover {
            background-color: #1565C0;
        }

        .containerPost .postes .postesTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }

        .containerPost .postes .postesTable thead {
            background-color: var(--border);
        }

        .containerPost .postes .postesTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }


        .containerPost .postes .postesTable tbody tr {
            border-bottom: 1px solid #ccc;
        }

        .containerPost .postes .postesTable tbody tr:last-child {
            border-bottom: none;
        }

        .containerPost .postes .postesTable td {
            text-align: left;
            padding: 12px 16px;
            border: none;
        }

        .containerPost .postes .filtersRow input {
            padding: 4px 8px;
            border: 1px solid #fff;

            border-radius: 10px;
            font-size: 0.9rem;
            color: black;
            border: 1px solid #ccc;
            height: 45px;
        }

        .containerPost .postes .filterName {
            width: 100%;
            margin-right: 200px;
        }

        .containerPost .postes .filterNb {
            width: 50%;
        }


        .containerPost .postes .detailsButton {
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .containerPost .postes .detailsButton:hover {
            background-color: #bbb;
        }


        @media screen and (max-width: 1080px) {
            .containerPost .postes .postesTable thead {
                display: none;
            }

            .containerPost .postes .postesTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }

            .containerPost .postes .postesTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }

            .containerPost .postes .postesTable tbody td::before {
                content: attr(data-label);
                font-weight: bold;
            }

            .containerPost .postes .addPostButton {
                width: 100%;
                margin-left: 0;
                margin-top: 10px;
            }

            .containerPost .postes .headerRow {
                display: block;
            }
        }
    </style>
</head>

<body>
    <?php include "../../../includes/header3.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar2.php"; ?>

        <div class="containerPost page">
            <section class="postes">

                <div class="headerRow">
                    <h2>Postes</h2>
                    <button class="addPostButton">Ajouter un poste</button>
                </div>

                <table class="postesTable">
                    <thead>
                        <tr>
                            <th>Nom du poste</th>
                            <th>Nb personnes liées</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th><input type="text" class="filterName" /></th>
                            <th><input type="number" class="filterNb" /></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td data-label="Nom du poste">Développeur Web</td>
                            <td data-label="Nb personnes liées">13</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>

                        <tr>
                            <td data-label="Nom du poste">Développeur applications mobiles</td>
                            <td data-label="Nb personnes liées">3</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>

                        <tr>
                            <td data-label="Nom du poste">Développeur C#</td>
                            <td data-label="Nb personnes liées">2</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>

                        <tr>
                            <td data-label="Nom du poste">Graphiste</td>
                            <td data-label="Nb personnes liées">1</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>

                        <tr>
                            <td data-label="Nom du poste">Community Manager</td>
                            <td data-label="Nb personnes liées">2</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                    </tbody>

                </table>
            </section>
        </div>
    </div>
</body>

</html>