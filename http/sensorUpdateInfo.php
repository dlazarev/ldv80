<?php
	$name = $_POST['sensor_name'];
	$description = $_POST['sensor_description'];
	$address = $_POST['sensor_address'];
	$x_coord = $_POST['sensor_x_coord'];
	$y_coord = $_POST['sensor_y_coord'];
	$floor = $_POST['sensor_floor'];

	$name = clean($name);
	$description = clean($description);
	$address = clean($address);
	$x_coord = clean($x_coord);
	$y_coord = clean($y_coord);
	$floor = clean($floor);

#	print_r($_POST);

	if (empty($name)) {
		print("Поле \"name\" не может быть пустым");
		return;
	}

	if (!check_length($name, 3, 400)) {
		print("Неверная длина поля \"name\"");
		return;
	}

	if (!check_length($description, 0, 400)) {
		print("Неверная длина поля \"desciption\"");
		return;
	}

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');

	$query = "SELECT upsert_sensors_desc('".$address."', '".$name."', '".$description."', ".$x_coord.", ".$y_coord.", ".$floor.")";
#	print_r($query);
	$result = $dbh->query($query);

	$dbh = null;

	header("Location: http://ldv80.perets.su/index.php");
	die();

} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}



function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
}

function check_length($value = "", $min, $max) {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}

?>
