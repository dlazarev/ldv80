<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less">
		<script src="scripts/less.min.js"></script>
		<title>Редактирование переменной</title>
	</head>
<body>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/header.php"
?>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/mainmenu.php"
?>
<div id="content">

<form action="variablesUpdate.php" method="post">
<table class="edit">

<?php
	print("<tr><td>Имя:</td><td width=40><input type=text name=var_name value=\"".$_GET['var_name']."\"></td></tr>\n");
	print("<tr><td>Значение:</td><td width=40><input type=text name=var_value value=\"".$_GET['var_value']."\"></td></tr>\n");
	print("<tr><td>Описание:</td><td width=40><input type=text name=var_desc value=\"".$_GET['var_desc']."\"></td></tr>\n");
?>	
	<tr><td colspan="2" align="left"><input type="submit" value="Записать изменения"></td></tr>
</table>
</form>

</div>
<div id="foot">Нижний Новгород, 2016г.</div>

</body>
</html>
