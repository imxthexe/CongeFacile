<?php
session_start();
$titre = 'Managers';
include '../../../includes/database.php';
include '../../../includes/header3.php';


$recupManagergers = $bdd->prepare("SELECT 
    d.name AS department_name,
    p.last_name,
    p.first_name,
    u.id
FROM user u
JOIN person p ON u.person_id = p.id
JOIN department d ON p.department_id = d.id
WHERE u.role = 'manager';");
$recupManagergers->execute();
$Managers = $recupManagergers->fetchAll(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="../../../style.css">

<style>
    .containerManagers {
        padding: 150px 0 0 350px; 
        /* Style modifié dans le css ne fonctionne d'où la balise style */
    }
</style>

<body>
    <?php include "../../../includes/header3.php"; ?>

    <div class="flex">
        <?php include "../../../includes/navBar/navBar3.php"; ?>


        <div class="containerManagers page">
            <section class="managersSection">

                <div class="headerRow">
                    <h2>Managers</h2>
                    <a href="ajout.php" class="addManagerButton">Ajouter un manager</a>
                </div>

                <table class="managersTable">
                    <thead>
                        <tr>
                            <th>Nom de famille</th>
                            <th>Prénom</th>
                            <th>Service rattaché</th>
                            <th></th>
                        </tr>
                        <tr class="filtersRow">
                            <th>
                                <input type="text" />
                            </th>
                            <th>
                                <input type="text" />
                            </th>
                            <th>
                                <input type="text" />
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($Managers)) {
                            foreach ($Managers as $Manager) {
                                $id = $Manager['id'];
                                echo "<tr>";
                                echo "<td data-label='Nom du poste'>" . htmlspecialchars($Manager['last_name']) . "</td>";
                                echo "<td data-label='Nom du poste'>" . htmlspecialchars($Manager['first_name']) . "</td>";
                                echo "<td data-label='Nom du poste'>" . htmlspecialchars($Manager['department_name']) . "</td>";
                                echo "<td><button class='detailsButton'><a  style='color:black;' href='modifications.php?id=$id'>Détails</a></button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7'>Aucun manager trouvé.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>

</html>