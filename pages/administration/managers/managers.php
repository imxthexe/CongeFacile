<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Managers</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>
        /* On préfixe chaque règle par .containerManagers 
           pour éviter les conflits avec les autres pages */

        .containerManagers {
            flex: 1;
            padding: 150px 0 0 50px;
        }

        .containerManagers .managersSection {
            padding: 20px;
            width: 75%;
        }

        .containerManagers .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 50px;
        }

        .containerManagers .headerRow h2 {
            margin: 0;
            padding: 0;
            font-size: 1.6rem;
            color: var(--color_title);
        }

        .containerManagers .addManagerButton {
            background-color: var(--color_btn);
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 20px;
            width: 150px;
        }

        .containerManagers .addManagerButton:hover {
            background-color: #1565C0;
        }

        .containerManagers .managersTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }

        .containerManagers .managersTable thead {
            background-color: var(--border);
        }

        .containerManagers .managersTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }

        .containerManagers .managersTable tbody tr {
            border-bottom: 1px solid #ccc;
        }

        .containerManagers .managersTable tbody tr:last-child {
            border-bottom: none;
        }

        .containerManagers .managersTable td {
            text-align: left;
            padding: 20px 16px;
            border: none;
        }

        .containerManagers .filtersRow input {
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9rem;
            width: 100%;
            height: 35px;
        }


        .containerManagers .detailsButton {
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .containerManagers .detailsButton:hover {
            background-color: #bbb;
        }


        @media screen and (max-width: 1080px) {
            .containerManagers .managersTable thead {
                display: none;
            }

            .containerManagers .managersTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }

            .containerManagers .managersTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }

            .containerManagers .managersTable tbody td::before {
                content: attr(data-label);
                font-weight: bold;
            }

            .containerManagers .addManagerButton {
                width: 100%;
                margin-left: 0;
                margin-top: 10px;
            }

            .containerManagers .headerRow {
                display: block;
            }
        }
    </style>
</head>

<body>
    <?php include "../../../includes/header.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar2.php"; ?>


        <div class="containerManagers">
            <section class="managersSection">

                <div class="headerRow">
                    <h2>Managers</h2>
                    <button class="addManagerButton">Ajouter un manager</button>
                </div>

                <table class="managersTable">
                    <thead>
                        <tr>
                            <th>Nom de famille</th>
                            <th>Prénom</th>
                            <th>Service rattaché</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th>
                                <input type="text" />
                            </th>
                            <th>
                                <input type="text" />
                            </th>
                            <th>
                                <input type="text" />
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Nom de famille">Salesse</td>
                            <td data-label="Prénom">Frédéric</td>
                            <td data-label="Service rattaché">BU Symfony</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom de famille">Salesse</td>
                            <td data-label="Prénom">Olivier</td>
                            <td data-label="Service rattaché">BU Marketing</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom de famille">Martin</td>
                            <td data-label="Prénom">Jean-Noël</td>
                            <td data-label="Service rattaché">BU Applications mobiles</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>

</html>