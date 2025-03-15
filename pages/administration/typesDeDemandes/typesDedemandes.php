<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Types de demandes</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>
        /* Même logique que ta page "Postes" */

        .containerPost {
            flex: 1;
            padding: 150px 0 0 50px;
        }

        .administration {
            padding: 20px;
            width: 75%;
        }

        /* Titre + bouton dans la même rangée */
        .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .headerRow h2 {
            margin: 0;
            padding: 0;
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
            width: 250px;
        }

        .addPostButton:hover {
            background-color: #1565C0;
        }

        /* Table principale */
        .demandeTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }

        .demandeTable thead {
            background-color: var(--border);
        }

        .demandeTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }

        /* Séparation horizontale entre chaque ligne du tbody */
        .demandeTable tbody tr {
            border-bottom: 1px solid #ccc;
        }

        .demandeTable tbody tr:last-child {
            border-bottom: none;
        }

        .demandeTable td {
            text-align: left;
            padding: 12px 16px;
            border: none;
        }

        /* Ligne de filtres dans le thead */
        .filtersRow input {
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9rem;
            height: 45px;
        }

        .filterName {
            width: 100%;
            margin-right: 200px;
        }

        .filterNb {
            width: 45%;
        }

        /* Bouton Détails */
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

        /* Responsive */
        @media screen and (max-width: 1080px) {
            /* On masque le thead et on affiche les data-label dans les cellules */
            .demandeTable thead {
                display: none;
            }

            .demandeTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }

            .demandeTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }

            .demandeTable tbody td::before {
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
        <?php include "../../../includes/navBar/navBar1.php"; ?>

        <div class="containerPost">
            <section class="administration">
                <!-- Titre + bouton d'ajout -->
                <div class="headerRow">
                    <h2>Types de demandes</h2>
                    <button class="addPostButton">Ajouter un type de demande</button>
                </div>

                <!-- Tableau -->
                <table class="demandeTable">
                    <thead>
                        <tr>
                            <th>Nom du type de demande</th>
                            <th>Nb demandes associées</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th>
                                <input type="text" class="filterName"/>
                            </th>
                            <th>
                                <input type="text" class="filterNb"/>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Nom du type de demande">Congé sans solde</td>
                            <td data-label="Nb demandes associées">400</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom du type de demande">Congé payé</td>
                            <td data-label="Nb demandes associées">1000</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom du type de demande">Congé maladie</td>
                            <td data-label="Nb demandes associées">750</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom du type de demande">Congé paternité</td>
                            <td data-label="Nb demandes associées">200</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom du type de demande">Autre</td>
                            <td data-label="Nb demandes associées">150</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
