<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Manager</title>

    <link rel="stylesheet" href="../../../style.css">

    <style>

        .containerManagerDetail {
            flex: 1;
            padding: 150px 0 0 50px;
        }

        .containerManagerDetail .managerDetail {
            padding: 20px;
            width: 75%;
        }

        .containerManagerDetail .managerDetail h2 {
            font-size: 1.6rem;
            color: var(--color_title);
            margin-bottom: 30px;
        }

        .containerManagerDetail .managerEditForm {
            max-width: 600px;
        }

        .containerManagerDetail .managerEditForm label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .containerManagerDetail .managerEditForm input[type="text"],
        .containerManagerDetail .managerEditForm input[type="email"],
        .containerManagerDetail .managerEditForm input[type="password"] {
            width: 350px;
            height: 40px;
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 4px;
            font-size: 1rem;
        }

        #managerEmail {
            padding-left: 50px;
        }

        .containerManagerDetail .managerEditForm input {
            margin-bottom: 20px;
        }

        .containerManagerDetail .inlineFields {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }
        .containerManagerDetail .inlineFields .fieldGroup {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .containerManagerDetail .managerUpdateBtn {
            background-color: var(--color_btn);
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 12px;
            cursor: pointer;
            width: 150px;
        }
        .containerManagerDetail .managerUpdateBtn:hover {
            background-color: #1565C0;
        }

        @media screen and (max-width: 1080px) {
            .containerManagerDetail {
                padding: 100px 20px 0 20px;
            }

            .containerManagerDetail .inlineFields {
                display: block;
            }
            .containerManagerDetail .inlineFields .fieldGroup {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include "../../../includes/header.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar1.php"; ?>

        <div class="containerManagerDetail">
            <section class="managerDetail">
                <h2>Salesse Frédéric</h2>

                <form class="managerEditForm">
                    <label for="managerEmail">Adresse email - champ obligatoire</label>
                    <input 
                        type="email" 
                        id="managerEmail" 
                        name="managerEmail" 
                        value="salesse@mentalworks.fr" 
                        required
                    />

                    <div class="inlineFields">
                        <div class="fieldGroup">
                            <label for="managerLastName">Nom de famille - champ obligatoire</label>
                            <input 
                                type="text" 
                                id="managerLastName" 
                                name="managerLastName" 
                                value="Salesse" 
                                required
                            />
                        </div>
                        <div class="fieldGroup">
                            <label for="managerFirstName">Prénom - champ obligatoire</label>
                            <input 
                                type="text" 
                                id="managerFirstName" 
                                name="managerFirstName" 
                                value="Frédéric" 
                                required
                            />
                        </div>
                    </div>

                    <label for="managerDirection">Direction/Service - champ obligatoire</label>
                    <input 
                        type="text" 
                        id="managerDirection" 
                        name="managerDirection" 
                        value="BU Symfony" 
                        required
                    />

                    <div class="inlineFields">
                        <div class="fieldGroup">
                            <label for="managerNewPassword">Nouveau mot de passe</label>
                            <input 
                                type="password" 
                                id="managerNewPassword" 
                                name="managerNewPassword"
                            />
                        </div>
                        <div class="fieldGroup">
                            <label for="managerConfirmPassword">Confirmation de mot de passe</label>
                            <input 
                                type="password" 
                                id="managerConfirmPassword" 
                                name="managerConfirmPassword"
                            />
                        </div>
                    </div>

                    <button type="submit" class="managerUpdateBtn">Mettre à jour</button>
                </form>
            </section>
        </div>
    </div>
</body>
</html>
