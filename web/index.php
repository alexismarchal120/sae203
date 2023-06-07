<!DOCTYPE html>
<html>
<head>
    <title>relever</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <canvas id="myChart"></canvas>
    <canvas id="test"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        <?php
        $db = new SQLite3('../basededonnee/sae203.db');
        $query = $db->query('SELECT * FROM temperature');
        $data = array();
        $labels = array();

        $query1 = $db->query('SELECT * FROM hummydite');
        $data1 = array();
        $labels1 = array();
        while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row['temp'];
            $labels[] = $row['jour']."/".$row['mois']."/".$row['annee'];
        }
        while ($row = $query1->fetchArray(SQLITE3_ASSOC)) {
            $data1[] = $row['taux'];
            $labels1[] = $row['jour']."/".$row['mois']."/".$row['annee'];
        }
        ?>

        var data = <?php echo json_encode($data); ?>;
        var labels = <?php echo json_encode($labels); ?>;

        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'température',
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
    <script>
        var ctx = document.getElementById('test').getContext('2d');

        
        
        <?php
        $db = new SQLite3('../basededonnee/sae203.db');
        $query1 = $db->query('SELECT * FROM hummydite');
        $data1 = array();
        $labels1 = array();
        
        while ($row = $query1->fetchArray(SQLITE3_ASSOC)) {
            $data1[] = $row['taux'];
            $labels1[] = $row['jour']."/".$row['mois']."/".$row['annee'];
        }
        ?>

        var data1 = <?php echo json_encode($data1); ?>;
        var labels1 = <?php echo json_encode($labels1); ?>;

        var test = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels1,
                datasets: [{
                    label: 'humidyte',
                    data: data1,
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
