<?php

	print_r($_POST);
	$var_name = clean($_POST['var_name']);
	$var_value = clean($_POST['var_value']);
	$var_desc = clean($_POST['var_desc']);
	
	if (!check_length($var_name, 3, 255)) {
		print('<script type="text/javascript">alert("Длина имени переменной должна быть от 3 до 255 символов!");window.location.href="http://ldv80.perets.su/variables.php";</script>');
	}
		
	if (!check_length($var_value, 1, 255)) {
		print('<script type="text/javascript">alert("Значение переменной не может быть пустым!");window.location.href="http://ldv80.perets.su/variables.php";</script>');
	}
	
	if (!check_length($var_desc, 0, 1023)) {
		print('<script type="text/javascript">alert("Длина описания не может превышать 1024 знака!");window.location.href="http://ldv80.perets.su/variables.php";</script>');
	}
	
try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='localhost'", 'ldv80');

	$query = "SELECT set_variable('".$var_name."', '".$var_value."', '".$var_desc."')";
	print_r($query);
	$result = $dbh->query($query);

	$dbh = null;

		header("Location: http://ldv80.perets.su/variables.php");
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
