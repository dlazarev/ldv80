<?php
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');
	print("<div><table id=list>\n");
	print("<tr id=list><th>Время последних показаний</th><th>Наименование</th><th>Темп.</th><th>Этаж</th><th>X</th><th>Y</th></tr>\n");
	foreach($dbh->query("select * from get_onewire_sensors_last_values()") as $row) {
		print "<tr id=list>\n";
			print("<td>".strftime("%d.%m.%Y %H:%M", strtotime($row['date']))."</td>\n");
			print("<td><a href='sensorEdit.php?address=".$row['address']."' data-tooltip=\"".$row['description']."\">".$row['name']."</a></td>\n");
			print("<td width=70 align=center>".$row['value']." &degC</td>\n");
			print("<td align=center>".$row['floor']."</td>\n");
			print("<td width=40 align=right>".$row['x_coord']."</td>\n");
			print("<td width=40 align=right>".$row['y_coord']."</td>\n");
		print "</tr>\n";
	}
	print "</table></div>\n";
	$dbh = null;
} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
