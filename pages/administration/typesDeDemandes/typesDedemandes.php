<?php
session_start();
$titre = 'Types de demandes';
include '../../../includes/database.php';
include '../../../includes/header3.php';


$RecupNombreDeDemandes = $bdd->prepare("SELECT 
                rt.id AS request_type_id, 
                rt.name AS request_type,
                COUNT(req.id) AS total_requests
            FROM request_type rt
            LEFT JOIN request req ON req.request_type_id = rt.id
            GROUP BY rt.id, rt.name");
$RecupNombreDeDemandes->execute();
$requetes_types = $RecupNombreDeDemandes->fetchAll(pdo::FETCH_ASSOC);





?>

<link rel="stylesheet" href="../../../style.css">



<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerDemandes page">
        <section class="Demandes">

            <div class="headerRow">
                <h1>Types de demandes</h1>
                <button class="addDemandeButton"><a style="color: white;" href="typesDedemandesAjout.php">Ajouter un type de demande</a></button>
            </div>


            <table class="demandeTable">
                <thead>
                    <tr>
                        <th>Nom du type de demande</th>
                        <th>Nb demandes associées</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th>
                            <input type="text" class="filterName" />
                        </th>
                        <th>
                            <input type="number" class="filterNb" minlength="0" />
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($requetes_types)) {
                        foreach ($requetes_types as $requete) {
                            $id = $requete['request_type_id'];
                            echo "<tr>";
                            echo "<td data-label='Type de demande'>" . htmlspecialchars($requete['request_type']) . "</td>";
                            echo "<td data-label='Demandé le'>" . htmlspecialchars($requete['total_requests']) . "</td>";
                            echo "<td><button class='detailsButton'><a  style='color:black;' href='typesDedemandeDetails.php?id=$id'>Détails</a></button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Aucune donnée trouvée.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>
</div>
</body>

</html>