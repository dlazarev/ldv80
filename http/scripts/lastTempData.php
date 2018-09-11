<?php 
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
$arr = array();

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');
	foreach($dbh->query("select * from get_onewire_sensors_last_values()") as $row) {
			$row['date'] = strftime("%d.%m.%Y %H:%M", strtotime($row['date']));
			array_push($arr, $row);
	
	}

	$new_arr = array();
	foreach ($arr as $elem) {
		$result = $dbh->query("select * from temp_difference_per_hour('".$elem['address']."')");
		$temp_diff = $result->fetch();
		array_push($elem, $temp_diff['temp_difference_per_hour']);
		array_push($new_arr, $elem);
//		print_r($elem);
	}
	
//	print("<p>");
//	print(json_encode($new_arr));
//	print("</p>");
	$ret_val = json_encode($new_arr);

	$dbh = null;
} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
