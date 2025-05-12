<?php
session_start();
$titre = 'Historique des demandes en attente';
include '../../../includes/database.php';
include '../../../includes/header3.php';

$recupPostes = $bdd->prepare("SELECT id, name FROM department");
$recupPostes->execute();
$Postes = $recupPostes->fetchAll(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="../../../style.css">


<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerPost page">
        <section class="administration">

            <div class="headerRow">
                <h2>Directions/Services</h2>
                <a class="addPostButton" href="ajout.php">Ajouter une direction/service</a>
            </div>


            <table class="directionsTable">
                <thead>
                    <tr>
                        <th>Nom de la direction ou du service</th>
                        <th></th>
                    </tr>
                    <tr class="filtersRow">
                        <th>
                            <input type="text" placeholder="Rechercher une direction ou un service" />
                        </th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    if (!empty($Postes)) {
                        foreach ($Postes as $Poste) {
                            $id = $Poste['id'];
                            echo "<tr>";
                            echo "<td data-label='Nom du poste'>" . htmlspecialchars($Poste['name']) . "</td>";
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