<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Mon équipe</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        .containerMonEquipe {
            flex: 1;
            padding: 120px 0 0 50px;
        }
        .containerMonEquipe .monEquipeSection {
            padding: 20px;
            width: 90%;
        }
        .containerMonEquipe .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .containerMonEquipe .headerRow h2 {
            margin: 0;
            padding: 0;
            font-size: 1.6rem;
            color: var(--color_title);
        }
        .containerMonEquipe .addCollaboratorButton {
            background-color: var(--color_btn);
            color: #fff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 20px;
            width: 180px; 
        }
        .containerMonEquipe .addCollaboratorButton:hover {
            background-color: #1565C0;
        }
        .containerMonEquipe .monEquipeTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }
        .containerMonEquipe .monEquipeTable thead {
            background-color: var(--border);
        }
        .containerMonEquipe .monEquipeTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }
        /* Ligne des filtres */
        .containerMonEquipe .filtersRow th {
            padding: 8px 0 8px 16px;
        }
        .containerMonEquipe .filtersRow input {
            width: 90%;
            height: 30px;
            padding: 0 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .containerMonEquipe .monEquipeTable tbody tr {
            border-bottom: 1px solid #ccc;
        }
        .containerMonEquipe .monEquipeTable tbody tr:last-child {
            border-bottom: none;
        }
        .containerMonEquipe .monEquipeTable td {
            text-align: left;
            padding: 20px 16px; /* Même logique que l'historique */
            border: none;
        }
        .containerMonEquipe .detailsButton {
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .containerMonEquipe .detailsButton:hover {
            background-color: #bbb;
        }
        @media screen and (max-width: 1080px) {
            .containerMonEquipe .monEquipeTable thead {
                display: none;
            }
            .containerMonEquipe .monEquipeTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }
            .containerMonEquipe .monEquipeTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }
            .containerMonEquipe .monEquipeTable tbody td::before {
                content: attr(data-label);
                font-weight: bold;
            }
            .containerMonEquipe .addCollaboratorButton {
                width: 100%;
                margin-left: 0;
                margin-top: 10px;
            }
            .containerMonEquipe .headerRow {
                display: block;
            }
        }
    </style>
</head>
<body>
    <?php include "../../includes/header2.php"; ?>
    <div class="flex">
        <?php include "../../includes/navBar/navBar1.php"; ?>
        <div class="containerMonEquipe">
            <section class="monEquipeSection">
                <div class="headerRow">
                    <h2>Mon équipe</h2>
                    <button class="addCollaboratorButton">Ajouter un collaborateur</button>
                </div>
                <table class="monEquipeTable">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Adresse email</th>
                            <th>Poste</th>
                            <th>Nb congés posés sur l'année</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th><input type="text" /></th>
                            <th><input type="text" /></th>
                            <th><input type="mail" /></th>
                            <th><input type="text" /></th>
                            <th><input type="number" /></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Nom">Martins</td>
                            <td data-label="Prénom">Jeff</td>
                            <td data-label="Adresse email">j.martins@mentalworks.fr</td>
                            <td data-label="Poste">Directeur technique</td>
                            <td data-label="Nb congés posés sur l'année">12</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom">Turcey</td>
                            <td data-label="Prénom">Adrien</td>
                            <td data-label="Adresse email">a.turcey@mentalworks.fr</td>
                            <td data-label="Poste">Lead Développeur</td>
                            <td data-label="Nb congés posés sur l'année">8</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom">Beharien</td>
                            <td data-label="Prénom">Matthieu</td>
                            <td data-label="Adresse email">m.beharien@mentalworks.fr</td>
                            <td data-label="Poste">Développeur Web</td>
                            <td data-label="Nb congés posés sur l'année">4</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom">Rivien</td>
                            <td data-label="Prénom">Mathias</td>
                            <td data-label="Adresse email">m.rivien@mentalworks.fr</td>
                            <td data-label="Poste">Développeur Web</td>
                            <td data-label="Nb congés posés sur l'année">3</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                        <tr>
                            <td data-label="Nom">Dupas</td>
                            <td data-label="Prénom">Lucas</td>
                            <td data-label="Adresse email">l.dupas@mentalworks.fr</td>
                            <td data-label="Poste">Test</td>
                            <td data-label="Nb congés posés sur l'année">5</td>
                            <td><button class="detailsButton">Détails</button></td>
                        </tr>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>
