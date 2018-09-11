<?php 
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
$arr = array();

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');
	foreach($dbh->query("select * from actuators order by id") as $row) {
			array_push($arr, $row);
	
	}

	$ret_val = json_encode($arr);

	$dbh = null;
} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
