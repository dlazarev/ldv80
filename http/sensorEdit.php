<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less">
		<script src="scripts/less.min.js"></script>
		<title>Редактирование параметров датчика</title>
	</head>
<body>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/header.php"
?>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/mainmenu.php"
?>
<div id="content">

<?php

error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
$address = $_GET['address'];

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');

	$result = $dbh->query("SELECT * from get_sensor_last_data('".$address."');");
	$row = $result->fetch(PDO::FETCH_ASSOC);
#print_r($row);
	print("<h1>Изменение параметров датчика</h1>\n");

?>

<form action="sensorUpdateInfo.php" method="post">
<table class="edit">

<?php
	print("<tr><td>Адрес:</td><td width=400><input type=text name=sensor_address hidden value=\"".$address."\">".$address."</td></tr>\n");
	print("<tr><td>Наименование:</td><td width=400><input size=40 maxlength=80 type=text name=sensor_name value=\"".$row['name']."\"></td></tr>\n");
	print("<tr><td>Описание:</td><td width=400><input size=60 maxlength=200 type=text name=sensor_description value=\"".$row['description']."\"></td></tr>\n");
	print("<tr><td>X координата:</td><td width=400><input min=10 max=800 type=number name=sensor_x_coord value=\"".$row['x_coord']."\"></td></tr>\n");
	print("<tr><td>Y координата:</td><td width=400><input min=10 max=800 type=number name=sensor_y_coord value=\"".$row['y_coord']."\"></td></tr>\n");
	print("<tr><td>Этаж:</td><td width=400><input min=0 max=2 type=number name=sensor_floor value=\"".$row['floor']."\"></td></tr>\n");
?>
<tr><td colspan="2" align="center"><input type="submit" value="Записать изменения"></td></tr>
</table>
</form>

<?php

	$dbh = null;
//	print_r($row);

} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


?>
</div>
<div id="foot">Нижний Новгород, 2016г.</div>

</body>
</html>
