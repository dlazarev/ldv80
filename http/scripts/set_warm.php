<?php
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
$address = '28FF404B69140448';

try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');

	$dbh->query("update schedules set active=true where name = 'warm';");
	$dbh = null;

} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
