<?php

$conn= new PDO('sqlite3:/base_de_donnee/sae203.db');
$results=$conn->query("SELECT * FROM temperature");

$dataPoints = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
    $date = str($row['jour']+"/"+$row['mois']+"/"+$row['annee']+" "+$row['heure']+":"+$row['min']+":"+$row['seconde']); // Conversion en millisecondes
    $temperature = $row['temp'];
    array_push($dataPoints, array("x" => $date, "y" => $temperature));
}

//humidite

$results = $conn->query("SELECT * FROM hummydite");
$dataPoints_humidite = array();
while ($row = $results->fetchArray(SQLITE3_ASSOC)) {
	$date = str($row['jour']+"/"+$row['mois']+"/"+$row['annee']+" "+$row['heure']+":"+$row['min']+":"+$row['seconde']); // Conversion en millisecondes
	$humidite = $row['taux'];
	array_push($dataPoints_humidite, array("x" => $date, "y" => $humidite));
}

?>
<html>
<head> 
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script>
window.onload = function () {

    var chart1 = new CanvasJS.Chart("chartContainer", {
        theme: "light1", // "light1", "light2", "dark1", "dark2"
        animationEnabled: true,
        zoomEnabled: true,
        title: {
            text: "Température en fonction de la date"
        },
        axisX: {
            title: "Date",
            valueFormatString: "YYYY-MM-DD HH:mm:ss"
        },
        axisY: {
            title: "Température"
        },
        data: [{
            type: "area",     
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    HTML

	var chart3 = new CanvasJS.Chart("chartContainer3", {
		theme: "light1", // "light1", "light2", "dark1", "dark2"
		animationEnabled: true,
		zoomEnabled: true,
		title: {
			text: "Humidite en fonction de la date"
		},
		axisX: {
			title: "Date",
			valueFormatString: "YYYY-MM-DD HH:mm:ss"
		},
		axisY: {
			title: "Humidite"
		},
		data: [{
			type: "area",     
			dataPoints: <?php echo json_encode($dataPoints_humidite, JSON_NUMERIC_CHECK); ?>
		}]
	});

    chart1.render();
    chart2.render();
	chart3.render();
}
</script>
</head>
<body>
<div id="chartContainer" style="width: 45%; height: 300px;display: inline-block;"></div>

<div id="chartContainer2" style="width: 45%; height: 300px;display: inline-block;"></div>

<div id="chartContainer3" style="width: 45%; height: 300px;display: inline-block;"></div>

<button onclick="window.print()">Imprimer</button> <!-- Bouton d'impression , possibilite 1-->
<button onclick = "window.location.href='script_pdf.php';"> Imprimer PHP</button>


</body>
</html>