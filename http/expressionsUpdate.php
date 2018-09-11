<?php
	$control = $_POST['control'];

	$sensor = $_POST['sensor'];
	$value = $_POST['value'];
	$compare_type = $_POST['compare_type'];

	$logical_op = $_POST['logical_op'];

	$control = clean($control);
	$value = clean($value);
	$address = clean($address);
	$compare_type = clean($compare_type);
	$logical_op = clean($logical_op);

	print_r($_POST);
/*
	print("\n");
	foreach ($sensor as $a => $b) {
		print($a." ".$sensor[$a]."\n");
	}

	print("\n");
	foreach ($value as $a => $b) {
		print($a." ".$value[$a]."\n");
	}


	if (empty($control)) {
		print("Поле \"control\" не может быть пустым");
		return;
	}

	if (empty($value)) {
		print("Поле \"value\" не может быть пустым");
		return;
	}

	if (!check_length($address, 16, 16)) {
		print("Неверная длина поля \"address\"");
		return;
	}
*/
try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='localhost'", 'ldv80');

#	$query = "SELECT upsert_sensors_desc('".$address."', '".$name."', '".$description."', ".$x_coord.", ".$y_coord.", ".$floor.")";
#	print_r($query);
#	$result = $dbh->query($query);

	$dbh = null;

#	header("Location: http://ldv80.perets.su/expressions.php");
#	die();

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
