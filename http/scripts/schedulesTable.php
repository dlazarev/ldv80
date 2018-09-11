<?php
error_reporting( E_ALL );
setlocale(LC_ALL, 'ru_RU.UTF-8');
try {
	$dbh = new PDO("pgsql:dbname='ldv80';host='ldv80.ddns.net';user='ldv80';password='sE48zc6RQjrD'", 'ldv80');
?>

<form class="expression" action="schedulesUpdate.php" method="post">
<script>
	$( function() {
		$(".datepicker").datepicker( $.datepicker.regional[ "ru" ] );
		$(".datepicker").datepicker({dateFormat: "yy-mm-dd", showAnim:"slide"});
	} );
</script>

<?php
	print("<div><table class=\"form\">\n");
	print("<thead><tr>\n");
	print("<th>Наименование</th>\n");
#	print("<th>Начало периода</th>\n");
#	print("<th>Конец периода</th>\n");
#	print("<th>Время старта</th>\n");
#	print("<th>Время окончания</th>\n");
#	print("<th colspan='7'>Дни недели</th>\n");
	print("</tr></thead>\n");
	
	print("<tbody>\n");
	foreach($dbh->query("select * from schedules order by id") as $row) {
		print "<tr>";
			print("<td><input type=text name='name' value='".$row['name']."'/></td>\n");
#			print("<td><input type=text class='datepicker' name='start_range' value='".$row['start_range']."'/></td>\n");
#			print("<td><input type=text class='datepicker' name='end_range' value='".$row['end_range']."'/></td>\n");
#			print("<td><input type=text name='start_at' value='".$row['start_at']."'/></td>\n");
#			print("<td><input type=text name='end_at' value='".$row['end_at']."'/></td>\n");
#			print("<td><input type=checkbox name='monday' value='Mon'/>Mon</td>\n");
#			print("<td><input type=checkbox name='tuesday' value='Tue'/>Tue</td>\n");
#			print("<td><input type=checkbox name='wednesday' value='Wed'/>Wed</td>\n");
#			print("<td><input type=checkbox name='thursday' value='Thu'/>Thu</td>\n");
#			print("<td><input type=checkbox name='friday' value='Fri'/>Fri</td>\n");
#			print("<td><input type=checkbox name='saturday' value='Sat'/>Sat</td>\n");
#			print("<td><input type=checkbox name='sunday' value='Sun'/>Sun</td>\n");
		print "</tr>\n";
	}
	print("</tbody>\n");
	print "</table></div>";
	$dbh = null;
?>

</form>

<?php	
} catch (PDOexception $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>
