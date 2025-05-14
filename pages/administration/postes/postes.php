<?php
session_start();
$titre = 'Postes';
include '../../../includes/database.php';
include '../../../includes/header3.php';

$recupNombrePostes = $bdd->prepare("SELECT 
    p.id AS position_id,
    p.name AS position_name,
    COUNT(pe.id) AS nombre_personnes
FROM 
    positions p
LEFT JOIN 
    person pe ON p.id = pe.position_id
GROUP BY 
    p.id, p.name
ORDER BY 
    nombre_personnes DESC;");
$recupNombrePostes->execute();
$Postes = $recupNombrePostes->fetchAll(pdo::FETCH_ASSOC);

?>

<link rel="stylesheet" href="../../../style.css">

<div class="flex">
    <?php include "../../../includes/navBar/navBar3.php"; ?>

    <div class="containerPost page">
        <section class="postes">

            <div class="headerRow">
                <h1>Postes</h1>
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
                            $id = $Poste['position_id'];
                            echo "<tr>";
                            echo "<td data-label='Nom du poste'>" . htmlspecialchars($Poste['position_name']) . "</td>";
                            echo "<td data-label='Nb personnes liées'>" . htmlspecialchars($Poste['nombre_personnes']) . "</td>";
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