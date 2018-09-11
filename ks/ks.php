<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less"/>
		<link rel="icon" type="image/png" href="img/SmartHouse-favicon.png"/>
		<script src="scripts/jquery-3.0.0.min.js"></script>
		<script src="scripts/less.min.js"></script>
		<title>ks</title>
	</head>
<body>

<?php
	require_once 'vendor/autoload.php';
	use InfluxDB\Database;
	use InfluxDB\Options;
	use InfluxDB\Point;
	use InfluxDB\Client;
print_r($_GET);
	$client = new InfluxDB\Client("localhost", 8086);
	$database = $client->selectDB('KS');
	$points = array(
		new Point(
			"sensors",
			$_GET['d5']+0.0,
			["device_id" => $_GET['i'], "sensor" => "wind_direction"]),

		new Point(
			"sensors",
			$_GET['p'] / 10.0,
			["device_id" => $_GET['i'], "sensor" => "pressure"]),

		new Point(
			"sensors",
			$_GET['thc']+0.0,
			["device_id" => $_GET['i'], "sensor" => "temp_internal"]),

		new Point(
			"sensors",
			$_GET['te2']+0.0,
			["device_id" => $_GET['i'], "sensor" => "temp_external"]),

		new Point(
			"sensors",
			$_GET['a']+0.0,
			["device_id" => $_GET['i'], "sensor" => "wind_speed_avg"]),

		new Point(
			"sensors",
			$_GET['m']+0.0,
			["device_id" => $_GET['i'], "sensor" => "wind_speed_min"]),

		new Point(
			"sensors",
			$_GET['g']+0.0,
			["device_id" => $_GET['i'], "sensor" => "wind_speed_max"]),

		new Point(
			"sensors",
			$_GET['accum'] / 44.9,
			["device_id" => $_GET['i'], "sensor" => "outlet_voltage"]),

		new Point(
			"sensors",
			$_GET['b'] / 100.0,
			["device_id" => $_GET['i'], "sensor" => "battery_voltage"]),

		new Point(
			"sensors",
			$_GET['h']+0.0,
			["device_id" => $_GET['i'], "sensor" => "humidity"]),

		new Point(
			"sensors",
			$_GET['th']+0.0,
			["device_id" => $_GET['i'], "sensor" => "temp_humidity"])

	);
	
	print_r($points);
	$result = $database->writePoints($points, Database::PRECISION_SECONDS);
?>


</body>
</html>