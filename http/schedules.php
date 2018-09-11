<!DOCTYPE html>
<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/getAllVariables.php";
?>

<html>
	<head>
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less">
		<link rel="stylesheet/less" type="text/css" href="css/datepicker.css">
		<link rel="icon" type="image/png" href="img/SmartHouse-favicon.png"/>
		<script   src="http://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
		<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"   integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="   crossorigin="anonymous"></script>
		<script src="scripts/datepicker-ru.js"></script>
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

	<h1>Расписания</h1>

		<?php
		include "/home/dmitry/ldv80.perets.su/http/scripts/schedulesTable.php"
		?>
</div>

<div id="tooltip"></div>

<div id="foot">Нижний Новгород, 2016г.</div>
</body>
</html>
