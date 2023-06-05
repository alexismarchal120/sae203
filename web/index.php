<!DOCTYPE html>
<html>
<head>
    <title>test</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        <?php
        $db = new SQLite3('/basededonnee/sae203.db');
        $query = $db->query('SELECT * FROM temperature');
        $data = array();
        $labels = array();

        while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row['jour']."/".$row['mois']."/".$row['annee'];
            $labels[] = $row['temp'];
        }
        ?>

        var data = <?php echo json_encode($data); ?>;
        var labels = <?php echo json_encode($labels); ?>;

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Mon graphique',
                    data: data,
                    backgroundColor: 'rgba(0, 123, 255, 0.5)'
                }]
            },
            options: {
                responsive: true,
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
