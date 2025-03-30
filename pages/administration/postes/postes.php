<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../../includes/database.php';
include '../../../includes/header3.php';

$recupNombrePostes = $bdd->prepare("SELECT 
                de.id AS department_id, 
                de.name AS department,
                COUNT(per.id) AS total_person
            FROM department de
            LEFT JOIN person per ON per.department_id = de.id
            GROUP BY de.id, de.name");
$recupNombrePostes->execute();
$Postes = $recupNombrePostes->fetchAll(pdo::FETCH_ASSOC);

?>

<link rel="stylesheet" href="../../../style.css">

<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerPost page">
        <section class="postes">

            <div class="headerRow">
                <h2>Postes</h2>
                <button class="addPostButton"><a style="color: white; font-family:epilogue;" href="ajout.php">Ajouter un poste</a></button>
            </div>

            <table class="postesTable">
                <thead>
                    <tr>
                        <th>Nom du poste</th>
                        <th>Nb personnes liées</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th><input type="text" class="filterName" /></th>
                        <th><input type="number" class="filterNb" /></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (!empty($Postes)) {
                        foreach ($Postes as $Poste) {
                            $id = $Poste['department_id'];
                            echo "<tr>";
                            echo "<td data-label='Nom du poste'>" . htmlspecialchars($Poste['department']) . "</td>";
                            echo "<td data-label='Nb personnes liées'>" . htmlspecialchars($Poste['total_person']) . "</td>";
                            echo "<td><button class='detailsButton'><a  style='color:black;' href='modifications.php?id=$id'>Détails</a></button></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>Aucun Poste trouvé.</td></tr>";
                    }
                    ?>
                </tbody>

            </table>
        </section>
    </div>
</div>
</body>

</html>