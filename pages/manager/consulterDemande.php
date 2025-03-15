<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Détail de la demande</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        .containerDemandeDetail {
            flex: 1;
            padding: 80px 0 0 50px;
        }

        .containerDemandeDetail .demandeDetailSection {
            width: 75%;
            padding: 20px;
        }

        .containerDemandeDetail .demandeDetailSection h2 {
            color: var(--color_title);
        }

        .containerDemandeDetail .demandeDetailSection p {
            margin-bottom: 10px;
        }

        .containerDemandeDetail .demandeDetailSection .activeP {
            color: #1565C0;
        }

        .containerDemandeDetail .demandeDetailSection .parameter {
            padding: 10px 0;
        }

        .containerDemandeDetail .demandeDetailSection h3 {
            margin-top: 20px;
            margin-bottom: 8px;
            font-size: 1.1rem;
            color: var(--color_title);
        }

        .containerDemandeDetail .demandeDetailSection .justifyButton {
            background-color: var(--border);
            color: #000;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 20px;
            width: 250px;
        }

        .containerDemandeDetail .demandeDetailSection .justifyButton:hover {
            background-color: #1565C0;
        }

        .containerDemandeDetail .demandeDetailSection .commentField1 {
            width: 100%;
            min-height: 180px;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 4px;
            margin-bottom: 20px;
            resize: none;
        }

        .containerDemandeDetail .demandeDetailSection .commentField2 {
            width: 100%;
            min-height: 80px;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 4px;
            margin-bottom: 20px;
            resize: none;
        }

        .containerDemandeDetail .demandeDetailSection .actionButtons {
            display: flex;
            gap: 10px;
            width: 450px;
        }

        .containerDemandeDetail .demandeDetailSection .refuseButton {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .containerDemandeDetail .demandeDetailSection .refuseButton:hover {
            background-color: #c0392b;
        }

        .containerDemandeDetail .demandeDetailSection .validateButton {
            background-color: #2ecc71;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .containerDemandeDetail .demandeDetailSection .validateButton:hover {
            background-color: #27ae60;
        }

        @media screen and (max-width: 1080px) {
            .containerDemandeDetail {
                padding: 80px 20px 0 20px;
            }
        }
    </style>
</head>

<body>
    <?php include "../../includes/header2.php"; ?>
    <div class="flex">
        <?php include "../../includes/navBar/navBar1.php"; ?>
        <div class="containerDemandeDetail">
            <section class="demandeDetailSection">
                <h2>Demande de Lucas Dupas</h2>
                <b>
                    <p class="activeP">Demande du 10/02/2024</p>
                </b>

                <div class="parameter">
                    <p>Période: 08/01/2025 13h30 au 08/01/2025 18h00</p>
                    <p>Type de demande: Congé payé</p>
                    <p>Nombre de jours: 0.5</p>
                </div>


                <p>Commentaire supplémentaire</p>
                <textarea class="commentField1" placeholder="Bonjour, j’aimerais prendre un après-midi pour pouvoir passer mon permis moto."></textarea>
                <button class="justifyButton">Télécharger le justificatif</button>
                <h3>Répondre à la demande</h3>
                <p>Saisir un commentaire</p>
                <textarea class="commentField2"></textarea>
                <div class="actionButtons">
                    <button class="refuseButton">Refuser la demande</button>
                    <button class="validateButton">Valider la demande</button>
                </div>
            </section>
        </div>
    </div>
</body>

</html>