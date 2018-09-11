<?php
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
$id = $_POST['id'];

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net'; user='ldv80' password='sE48zc6RQjrD'", 'ldv80');

	$query = "SELECT * from actuators WHERE id = '".$id."';";
	$result = $dbh->query($query);
	$row = $result->fetch(PDO::FETCH_ASSOC);

	$dbh = null;
//	print_r($query);
	print(json_encode($row));

} catch (PDOexception $e) {
    print("Error!: " . $e->getMessage() . "<br/>");
    die();
}
?>
