<!DOCTYPE html>

<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/lastTempData.php"
?>

<html>
	<head>
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less"/>
		<link rel="icon" type="image/png" href="img/SmartHouse-favicon.png"/>
		<script src="scripts/jquery-3.0.0.min.js"></script>
		<script src="scripts/less.min.js"></script>
		<script src="scripts/plan.js"></script>
		<script>
			var val_php = '<?=$ret_val;?>';
			$(document).ready(function() {
				var arr = JSON.parse(val_php);
				displayFloors(arr);
			});
		</script>
		<title>План умного дома</title>
	</head>
<body>
<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/header.php"
?>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/mainmenu.php"
?>

<div id="content">

	<h1>Температура в помещениях</h1>
	<div id="sensor">
		<canvas id="firstFloor" width="400" height="400"></canvas>
	</div>
	<div id="sensor">
		<canvas id="secondFloor" width="400" height="400"></canvas>
	</div>
</div>

<div id="foot">Нижний Новгород, 2016г.</div>

</body>
</html>
