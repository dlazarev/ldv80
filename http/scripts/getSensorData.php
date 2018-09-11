<?php
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
$address = $_POST['address'];

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');

	$result = $dbh->query("SELECT * from get_sensor_last_data('".$address."');");
	$row = $result->fetch(PDO::FETCH_ASSOC);

	$result = $dbh->query("select * from temp_difference_per_hour('".$address."')");
	$temp_diff = $result->fetch(PDO::FETCH_ASSOC);
	$row['temp_diff'] =$temp_diff['temp_difference_per_hour'];

	$dbh = null;
//	print_r($row);
	print(json_encode($row));

} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
