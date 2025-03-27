<!-- <!DOCTYPE html>
<html lang="fr"> -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Demandes en attente</title>

    <link rel="stylesheet" href="../../../style.css">

    <?php if ((!isset($_SESSION['utilisateur']) && $_SESSION['utilisateur'] != "manager")) {
        header("Location : ../commun/connexion.php");
    } ?>
    <style>
        .containerDemandesAttente {
            flex: 1;
            padding: 80px 0 0 50px;
        }

        .containerDemandesAttente .demandesAttenteSection {
            padding: 20px;
            width: 90%;
        }

        .containerDemandesAttente .headerRow {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .containerDemandesAttente .headerRow h2 {
            margin: 0;
            font-size: 1.6rem;
            color: var(--color_title);
        }

        .containerDemandesAttente .demandesAttenteTable {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border: 1px solid var(--border);
        }

        .containerDemandesAttente .demandesAttenteTable thead {
            background-color: var(--border);
        }

        .containerDemandesAttente .demandesAttenteTable thead th {
            text-align: left;
            padding: 12px 0 12px 16px;
            border: none;
        }

        .containerDemandesAttente .filtersRow th {
            padding: 8px 0 8px 16px;
        }

        .containerDemandesAttente .filtersRow input {
            width: 90%;
            padding: 4px 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9rem;
        }

        .containerDemandesAttente .demandesAttenteTable tbody tr {
            border-bottom: 1px solid #ccc;
        }

        .containerDemandesAttente .demandesAttenteTable tbody tr:last-child {
            border-bottom: none;
        }

        .containerDemandesAttente .demandesAttenteTable td {
            text-align: left;
            padding: 20px 16px;
            border: none;
        }

        .containerDemandesAttente .detailsButton {
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .containerDemandesAttente .detailsButton:hover {
            background-color: #bbb;
        }

        @media screen and (max-width: 1080px) {
            .containerDemandesAttente .demandesAttenteTable thead {
                display: none;
            }

            .containerDemandesAttente .demandesAttenteTable tbody tr {
                display: block;
                margin-bottom: 15px;
                border: 1px solid #ddd;
            }

            .containerDemandesAttente .demandesAttenteTable tbody td {
                display: flex;
                justify-content: space-between;
                padding: 10px;
            }

            .containerDemandesAttente .demandesAttenteTable tbody td::before {
                content: attr(data-label);
                font-weight: bold;
            }
        }
    </style>
</head>

<body>

    <div class="flex"
        <?php include "../../includes/navBar/navBar1.php"; ?>

        <div class="containerDemandesAttente page">
        <section class="demandesAttenteSection">
            <div class="headerRow">
                <h2>Demandes en attente</h2>
            </div>

            <table class="demandesAttenteTable">
                <thead>
                    <tr>
                        <th>Type de demande</th>
                        <th>Demande le</th>
                        <th>Collaborateur</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Nb jours</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="text" /></th>
                        <th><input type="date" /></th>
                        <th><input type="date" /></th>
                        <th><input type="number" /></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Type de demande">Congé sans solde</td>
                        <td data-label="Demande le">03/01/2024 08:00</td>
                        <td data-label="Collaborateur">Lucas Dupas</td>
                        <td data-label="Date de début">10/01/2024 08:00</td>
                        <td data-label="Date de fin">15/01/2024 08:00</td>
                        <td data-label="Nb jours">5 jours</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Type de demande">Congé payé</td>
                        <td data-label="Demande le">29/12/2023 08:00</td>
                        <td data-label="Collaborateur">Jeff Martins</td>
                        <td data-label="Date de début">12/01/2024 08:00</td>
                        <td data-label="Date de fin">20/01/2024 08:00</td>
                        <td data-label="Nb jours">8 jours</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Type de demande">Congé sans solde</td>
                        <td data-label="Demande le">05/01/2024 08:00</td>
                        <td data-label="Collaborateur">Adrien Turcey</td>
                        <td data-label="Date de début">09/01/2024 08:00</td>
                        <td data-label="Date de fin">15/01/2024 08:00</td>
                        <td data-label="Nb jours">6 jours</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Type de demande">Congé maladie</td>
                        <td data-label="Demande le">10/01/2024 08:00</td>
                        <td data-label="Collaborateur">Nicolas Verdier</td>
                        <td data-label="Date de début">15/01/2024 08:00</td>
                        <td data-label="Date de fin">18/01/2024 08:00</td>
                        <td data-label="Nb jours">3 jours</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                    <tr>
                        <td data-label="Type de demande">Congé sans solde</td>
                        <td data-label="Demande le">28/12/2023 08:00</td>
                        <td data-label="Collaborateur">Jeff Martins</td>
                        <td data-label="Date de début">07/01/2024 08:00</td>
                        <td data-label="Date de fin">12/01/2024 08:00</td>
                        <td data-label="Nb jours">5 jours</td>
                        <td><button class="detailsButton">Détails</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
    </div>
</body>

</html>