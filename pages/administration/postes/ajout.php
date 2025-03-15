<!-- BURGER MENU -->
<!-- LE STYLESHEET NE FONCTIONNE TOUJORUS PAS mais les root foncitonne, je comprend rien-->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ajout - Détails du poste</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>

        .containerPost {
            flex: 1;
            padding: 150px 0 0 50px;
        }

        .containerPost .ajout {
            padding: 20px;
            width: 75%;
        }

        .containerPost .ajout h2 {
            font-size: 1.6rem;
            color: var(--color_title);
            margin-bottom: 30px;
        }

        .containerPost .editPostForm {
            max-width: 400px;
        }

        .containerPost .editPostForm label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .containerPost .editPostForm input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 1rem;
        }


        .containerPost .actionButtons {
            display: flex;
            gap: 10px;
        }

        .containerPost .deleteBtn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .containerPost .deleteBtn:hover {
            background-color: #c0392b;
        }

        .containerPost .updateBtn {
            background-color: var(--color_btn);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .containerPost .updateBtn:hover {
            background-color: #1565C0;
        }

        /* RESPONSIVE */
        @media screen and (max-width: 1080px) {
            .containerPost {
                padding: 100px 20px 0 20px;
            }
        }
    </style>
</head>

<body>
    <?php include "../../../includes/header.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar1.php"; ?>

        <div class="containerPost">
            <section class="ajout">

                <h2>Développeur Web</h2>

                <form class="editPostForm">
                    <label for="nomPoste">Nom du poste</label>
                    <input type="text" id="nomPoste" name="nomPoste" value="Développeur Web" />

                    <div class="actionButtons">
                        <button type="button" class="deleteBtn">Supprimer</button>
                        <button type="submit" class="updateBtn">Mettre à jour</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
