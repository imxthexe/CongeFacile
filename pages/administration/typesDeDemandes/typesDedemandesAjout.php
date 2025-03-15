<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Types de demandes</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>

        .containerAjoutDemande {
            flex: 1;
            padding: 150px 0 0 50px;
        }

        .containerAjoutDemande .administration {
            padding: 20px;
            width: 75%;
        }


        .containerAjoutDemande .administration h2 {
            font-size: 1.6rem;
            color: var(--color_title);
            margin-bottom: 30px;
        }


        .containerAjoutDemande .editTypeForm {
            max-width: 400px;
        }

        .containerAjoutDemande .editTypeForm label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }

        .containerAjoutDemande .editTypeForm input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .containerAjoutDemande .actionButtons {
            display: flex;
            gap: 10px; 
        }

        .containerAjoutDemande .deleteBtn {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .containerAjoutDemande .deleteBtn:hover {
            background-color: #c0392b;
        }

        .containerAjoutDemande .updateBtn {
            background-color: var(--color_btn);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
        }

        .containerAjoutDemande .updateBtn:hover {
            background-color: #1565C0;
        }

        @media screen and (max-width: 1080px) {
            .containerAjoutDemande .containerAjoutDemande {
                padding: 100px 20px 0 20px;
            }
        }
    </style>
</head>

<body>
    <?php include "../../../includes/header.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar1.php"; ?>

        <div class="containerAjoutDemande">
            <section class="administration">
                <h2>Types de demandes</h2>

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
