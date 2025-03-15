<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Types de demandes</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>
        /* Même logique que ta page "Détails d'un poste" */

        .containerPost {
            flex: 1;
            padding: 150px 0 0 50px;
        }

        .administration {
            padding: 20px;
            width: 75%;
        }

        /* Titre principal */
        .administration h2 {
            font-size: 1.6rem;
            color: var(--color_title);
            margin-bottom: 30px;
        }

        /* Formulaire d'édition du type de demande */
        .editTypeForm {
            max-width: 400px; /* Largeur du formulaire */
        }

        .editTypeForm label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .editTypeForm input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        /* Boutons d'action */
        .actionButtons {
            display: flex;
            gap: 10px; /* Espace horizontal entre les boutons */
        }

        .deleteBtn {
            background-color: #e74c3c; /* Rouge */
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .deleteBtn:hover {
            background-color: #c0392b;
        }

        .updateBtn {
            background-color: var(--color_btn); /* Même variable que ton bouton principal */
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .updateBtn:hover {
            background-color: #1565C0;
        }

        /* Responsive */
        @media screen and (max-width: 1080px) {
            /* Gère le responsive de la nav bar (réalisé par Mthis normalement) */
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
            <section class="administration">
                <!-- Titre de la page -->
                <h2>Types de demandes</h2>

                <!-- Formulaire d'édition -->
                <form class="editTypeForm">
                    <label for="nomType">Nom du type</label>
                    <input 
                        type="text" 
                        id="nomType" 
                        name="nomType" 
                        value="Congé payé" 
                    />

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
