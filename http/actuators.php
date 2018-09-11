<!DOCTYPE html>
<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/getActuatorsStates.php";
?>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less">
		<link rel="icon" type="image/png" href="img/SmartHouse-favicon.png"/>
		<title>Актуаторы (исполнительные реле)</title>
		<script src="scripts/jquery-3.0.0.min.js"></script>
		<script src="scripts/less.min.js"></script>
		<script src="scripts/displayActuator.js"></script>
		<script>
		var val_php = '<?=$ret_val;?>';

		$(document).ready(function() {
			var arr = JSON.parse(val_php);
			// Выводим первый раз, чтобы сразу отобразилось
			for (var i=0; i < arr.length; i++) {
				var canvas = document.getElementById("actuator" + arr[i]['id']);
				displayActuator(canvas);
			}

			$("[data-tooltip]").mousemove(function(event) {
				$data_tooltip = $(this).attr("data-tooltip");
				$("#tooltip").text($data_tooltip)
					.css({
						"top" : event.pageY + 5,
						"left" : event.pageX + 5
					}).show();
				}).mouseout(function() {
					$("#tooltip").hide()
						.text("")
						.css({
							"top" : 0,
							"left" : 0
						});
					});


		});

		</script>

	</head>
	<body>
<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/header.php"
?>

<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/mainmenu.php"
?>

</div>

<div id="content">
<?php
	foreach (json_decode($ret_val, true) as $row) {
		print ('<div id="sensor">');
		print ('<canvas id="actuator'.$row['id'].'" width="90" height="140" onclick="mouseclick(event)" data-tooltip="'.$row['id'].'"></canvas>');
		print ("</div>\n");
	}
?>
</div>

<div id="foot">Нижний Новгород, 2016г.</div>

</div>
	<div id="tooltip"></div>
	</body>
</html>
