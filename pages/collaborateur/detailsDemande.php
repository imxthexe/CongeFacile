<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma demande de congé</title>
    <link rel="stylesheet" href="../../style.css">
    <style>
        .containerMaDemande {
            flex: 1;
            padding: 80px 0 0 50px;
        }

        .containerMaDemande .maDemandeSection {
            padding: 20px;
            width: 75%;
        }

        .containerMaDemande .maDemandeSection h2 {
            font-size: 1.6rem;
            color: var(--color_title);
            margin-bottom: 20px;
        }

        .containerMaDemande .maDemandeSection p {
            margin-bottom: 10px;
            line-height: 1.4;
        }

        .containerMaDemande .maDemandeSection .activeP {
            color: #1565C0;
        }

        .containerMaDemande .maDemandeSection .parameter {
            padding: 10px 0;
        }

        .containerMaDemande .maDemandeSection .comment{
            margin: 20px 0;
        }
        .containerMaDemande .maDemandeSection textarea{
            resize: none;
            height: 200px;
            width: 800px;
        }
        .containerMaDemande .maDemandeSection .statutValide {
            display: inline-block;
            background-color:rgba(46, 204, 112, 0.25);
            color: green;
            padding: 4px 8px;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-left: 20px;
        }

        .containerMaDemande .maDemandeSection .backButton {
            margin-top: 20px;
            background-color: var(--border);
            color: #333;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 300px;
        }

        .containerMaDemande .maDemandeSection .backButton:hover {
            background-color: #bbb;
        }

        @media screen and (max-width: 1080px) {
            .containerMaDemande {
                padding: 80px 20px 0 20px;
            }
        }
    </style>
</head>

<body>
    <?php include "../../includes/header2.php"; ?>
    <div class="flex">
        <?php include "../../includes/navBar/navBar1.php"; ?>
        <div class="containerMaDemande">
            <section class="maDemandeSection">

                <h2>Ma demande de congé</h2>

                <b>
                    <p class="activeP">type de demande: Congé payé</p>
                </b>

                <div class="parameter">
                    <p>Demande du 10/12/2024</p>
                    <p>Période : 20/12/2024 08h00 au 23/12/2024 18h00</p>
                    <p>Nombre de jours : 3 jours</p>
                </div>


                <p>Statut de la demande : <span class="statutValide">Validé</span></p>

                <p class="comment">Commentaire du manager :</p>

                <textarea placeholder="Bon temps de vacances à Mayrouge et surtout, n'oublie pas la carte postale !!!"></textarea>
                <button class="backButton">Retourner à la liste de mes demandes</button>
            </section>
        </div>
    </div>
</body>

</html>