<?php
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');
	print("<div><table id=list>\n");
	print("<tr id=list><th align='left'>Имя</th><th align='left'>Значение</th><th align='left'>Описание</th></tr>\n");
	foreach($dbh->query("select * from variables") as $row) {
		print "<tr id=list>\n";
			print("<td width=100>".$row['name']."</td>\n");
			$data = array('var_name' => $row['name'], 'var_value' => $row['value'], 'var_desc' => $row['description']);
			$get_query = http_build_query($data);
			print("<td width=120><a href='varEdit.php?".$get_query."'>".$row['value']."</a></td>\n");
			print("<td width=200>".$row['description']."</td>\n");
		print "</tr>\n";
	}
	print "</table></div>\n";
	$dbh = null;
} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
