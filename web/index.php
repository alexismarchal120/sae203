<!DOCTYPE html>
<html>
<head>
    <title>relever</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="background:black;">
    <h1 style="text-align: center; color:white;"><strong>Meteo</strong></h1>
    <br>
    <br>
    <h2 style="color:white;">Température :(en °C)</h2><br>
    <canvas id="myChart" style="color:white;"></canvas><br>
    <h2 style="color:white;">Humidyte :(en %)</h2><br>
    <canvas id="test" style="color:white;"></canvas>
    
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
  

        <?php
        $db = new SQLite3('../basededonnee/sae203.db');
        $query = $db->query('SELECT * FROM temperature');
        $data = array();
        $labels = array();

    
        while ($row = $query->fetchArray(SQLITE3_ASSOC)) {
            $data[] = $row['temp'];
            $labels[] = $row['jour']."/".$row['mois']."/".$row['annee']."\n".$row['heure']."H".$row['min']."m".$row['seconde']."s";
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
                    backgroundColor: 'rgba(0, 123, 255, 1)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    },
                }
            }
        });
    </script>
    <script>
        var ctx = document.getElementById('test').getContext('2d');

        
        
        <?php
        $query1 = $db->query('SELECT * FROM hummydite');
        $data1 = array();
        $labels1 = array();
        
        while ($row = $query1->fetchArray(SQLITE3_ASSOC)) {
            $data1[] = $row['taux'];
            $labels1[] = $row['jour']."/".$row['mois']."/".$row['annee']."\n".$row['heure']."H".$row['min']."m".$row['seconde']."s";;
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
                    backgroundColor: 'rgb(255, 0, 0)',
                    borderColor: 'rgb(255,0,0)',
                    borderWidth: 2,
                    fill:false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>
</body>
</html>
