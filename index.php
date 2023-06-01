<!DOCTYPE html>
<html>
<head>
    <title>Affichage des données sous forme de graphique</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart" width="400" height="400"></canvas>

    <?php
    // Connexion à la base de données SQLite
    $dbname = 'chemin_vers_votre_base_de_données.sqlite';
    $conn = new SQLite3($dbname);

    // Récupération des données depuis la base de données
    $query = "SELECT * FROM table_donnees";
    $result = $conn->query($query);
 
    $labels = [];
    $data = [];

    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $labels[] = $row['label'];
        $data[] = $row['valeur'];
    }

    $conn->close();
    ?>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Données',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
