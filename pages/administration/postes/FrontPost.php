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
            body {
                font-family: Arial, sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding: 40px;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .postContainer {
                width: 70%;
                background: white;
                padding: 20px;
                border-radius: 10px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1 {
                color: #1a1a1a;
                font-size: 24px;
                margin-bottom: 20px;
            }

            .btn {
                background-color: #0d6efd;
                color: white;
                border: none;
                padding: 10px 15px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            th,
            td {
                padding: 12px;
                border-bottom: 1px solid #ddd;
                text-align: left;
            }

            th {
                background-color: #f1f1f1;
                font-weight: bold;
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
                justify-content: space-between;
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

        <?php include "../../../includes/header3.php" ?>


        <div class="flex">
            <?php include "../../../includes/haader3.php" ?>


            <div class="postContainer">


                <div class="post">


                    <div class="top-menu">
                        <h1>Postes</h1>
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