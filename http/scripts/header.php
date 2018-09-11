<?php
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
$address = '28FF404B69140448';

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');

	$result = $dbh->query("SELECT * from get_sensor_last_data('".$address."');");
	$row = $result->fetch(PDO::FETCH_ASSOC);

	$result = $dbh->query("select * from temp_difference_per_hour('".$address."')");
	$temp_diff = $result->fetch(PDO::FETCH_ASSOC);
	$row['temp_diff'] =$temp_diff['temp_difference_per_hour'];

	$result = $dbh->query("select boiler_today_timing()");
	$boiler_timing = $result->fetch(PDO::FETCH_NUM);
	list($abc_boiler, $percent_boiler) = split(",", $boiler_timing[0]);
	$abc_boiler = preg_replace("/.(\d\d):(\d\d):(\d\d).+/", "$1:$2:$3", $abc_boiler);
	$percent_boiler = (float)substr($percent_boiler, 0, 6) * 100;
	$dbh = null;

} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
<div class="header">
<!--	<image src="../img/header.jpg" style="width:100%; height:100px;"/> -->

	<?php
		print("<p>".$row['temp']." &degC</p>");
		print('<p style="font-size:12px;">'.$row['date']."</p>");
		print("<p><image src='/img/fire.png' width=16px/>");
		print($abc_boiler.' ('.$percent_boiler.'%)</p>');
	?>
	<form action=scripts/set_warm.php>
		<input type=submit value="Мне холодно!">
	</form>
</div>

