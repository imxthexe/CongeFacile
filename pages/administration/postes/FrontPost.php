<!-- PAGE FrontPost.php  CREE CAR JE SAVAIS PAS POUUQOI IL Y AVAIT 3 AUTRES PAGES DONC JAI RAJOUTE ELLE JUSTE POUR LE FRONT -->
<!-- ANTOINE -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../../../style.css">

</head>

<body>

    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Postes</title>
        <style>
            .postContainer {
                padding: 150px 0 0 50px;
                width: 55%;
            }

            .post {
                width: 70%;
                background: white;
                padding: 20px;
                border-radius: 10px;
            }



            .btn {
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                background-color: var(--color_btn);
                width: 150px;
                margin-left: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            thead {
                width: 100%;
            }

            th {
                /* background-color: #f1f1f1; */
                /* font-weight: bold; */
                background-color: yellow;
                width: 1500px;
            }

            td {
                /* padding: 12px;
                border-bottom: 1px solid #ddd;
                text-align: left;
                width: 100%; */
            }

            .details-btn {
                background-color: #e0e0e0;
                border: none;
                padding: 8px 12px;
                cursor: pointer;
                border-radius: 5px;
                font-size: 14px;
            }

            .top-menu {
                display: flex;
                align-items: center;
            }

            .filters {
                display: flex;
                gap: 10px;
            }

            .filters input {
                width: 100%;
                padding: 8px;
                border: 1px solid #ddd;
                border-radius: 5px;
                font-size: 14px;
            }
        </style>
    </head>

    <body>

        <?php include "../../../includes/header.php" ?>


        <div class="flex">
            <?php include "../../../includes/navBar/navBar1.php" ?>


            <div class="postContainer">

                <div class="post">



                    <div class="top-menu">
                        <h2>Postes</h2>
                        <button class="btn">Ajouter un poste</button>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>
                                    Nom du poste
                                    <input type="text" placeholder="Rechercher un poste">
                                </th>
                                <th>
                                    Nb personnes liées
                                    <input type="number" placeholder="Rechercher un nombre">
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td>Développeur Web</td>
                                <td>13</td>
                                <td><button class="details-btn">Détails</button></td>
                            </tr>

                            <tr>
                                <td>Développeur applications mobiles</td>
                                <td>4</td>
                                <td><button class="details-btn">Détails</button></td>
                            </tr>

                            <tr>
                                <td>Développeur C#</td>
                                <td>3</td>
                                <td><button class="details-btn">Détails</button></td>
                            </tr>

                            <tr>
                                <td>Graphiste</td>
                                <td>2</td>
                                <td><button class="details-btn">Détails</button></td>
                            </tr>

                            <tr>
                                <td>Community Manager</td>
                                <td>1</td>
                                <td><button class="details-btn">Détails</button></td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


    </body>

    </html>


</body>

</html>