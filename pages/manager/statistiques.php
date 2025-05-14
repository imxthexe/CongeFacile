<link rel="stylesheet" href="../../style.css" />
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<?php
session_start();
include '../../includes/header2.php';
include_once __DIR__ . '/../../includes/database.php'; // contient $bdd


// Préparation des statistiques
$typeStats = [];
$acceptStats = array_fill(1, 12, ['accepted' => 0, 'total' => 0]);

// RECUP LES STATS
$query = "SELECT rt.name as request_type, r.answer as status, MONTH(r.created_at) as month 
           FROM request r
           JOIN request_type rt ON r.request_type_id = rt.id";

$stmt = $bdd->query($query);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $row) {
    $type = $row['request_type'];
    $mois = (int)$row['month'];
    $statut = $row['status'];

    // Statistiques par type de congé
    $typeStats[$type] = ($typeStats[$type] ?? 0) + 1;

    // Statistiques par mois
    $acceptStats[$mois]['total'] += 1;
    if ($statut == 1) {  // 1 = Acceptée
        $acceptStats[$mois]['accepted'] += 1;
    }
}

// Transformation des données pour Chart.js
$typeLabels = json_encode(array_keys($typeStats));
$typeData = json_encode(array_values($typeStats));
$monthlyLabels = json_encode(array_keys($acceptStats));
$monthlyAccepted = json_encode(array_column($acceptStats, 'accepted'));
$monthlyTotal = json_encode(array_column($acceptStats, 'total'));



$titre = 'Statistiques';

?>

<body>


    <div class="flex">

        <?php include "../../includes/navBar/navBar2.php"; ?>

        <div class="page">
            <div class="statistiquesSection">
                <h2>Statistiques</h2>
                <p>Types de demandes sur l’année</p>
                <canvas id="chartTypesDemandes" width="400" height="400"></canvas>

                <h2>Pourcentage d’acceptation des demandes sur l’année</h2>
                <canvas id="chartTauxAcceptation" width="600" height="300"></canvas>
            </div>
        </div>
    </div>

    <script>
        const typesData = <?= json_encode($typeStats) ?>;
        const acceptData = <?= json_encode($acceptStats) ?>;


        const ctx1 = document.getElementById('chartTypesDemandes').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: Object.keys(typesData),
                datasets: [{
                    data: Object.values(typesData),
                    backgroundColor: ['#4285F4', '#FBBC05', '#34A853', '#EA4335', '#FF9900']
                }]
            }
        });


        const mois = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
        const taux = Object.values(acceptData).map(val =>
            val.total > 0 ? (val.accepted / val.total * 100).toFixed(2) : 0
        );

        const ctx2 = document.getElementById('chartTauxAcceptation').getContext('2d');
        new Chart(ctx2, {
            type: 'line',
            data: {
                labels: mois,
                datasets: [{
                    label: '% acceptées',
                    data: taux,
                    borderColor: '#004c6c',
                    tension: 0.4,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>


</body>