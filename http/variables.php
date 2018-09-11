<!DOCTYPE html>
<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/getAllVariables.php";
?>

<html>
	<head>
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less">
		<link rel="icon" type="image/png" href="img/SmartHouse-favicon.png"/>
		<script src="scripts/jquery-3.0.0.min.js"></script>
		<script src="scripts/less.min.js"></script>
		<script>
			var val_php = '<?=$ret_val;?>';
		</script>
		<title>Управление переменными</title>
	</head>
<body>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/header.php"
?>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/mainmenu.php"
?>

<div id="content">

	<h1>Управление переменными</h1>

		<?php
		include "/home/dmitry/ldv80.perets.su/http/scripts/variablesTable.php"
		?>
</div>

<div id="tooltip"></div>

<div id="foot">Нижний Новгород, 2016г.</div>
</body>
</html>

