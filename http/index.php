<!DOCTYPE html>

<html>
	<head>
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less"/>
		<link rel="icon" type="image/png" href="img/SmartHouse-favicon.png"/>
		<script src="scripts/jquery-3.0.0.min.js"></script>
		<script src="scripts/less.min.js"></script>
		<title>Умный дом</title>
	</head>
<body>
<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/header.php"
?>

<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/mainmenu.php"
?>

<div id="content">

	<h1>Список температурных датчиков</h1>
	<?php
		include "/home/dmitry/ldv80.perets.su/http/scripts/last_temp.php"
	?>
		<script>
			$(document).ready(function() {

			$("[data-tooltip]").mousemove(function (eventObject) {

				$data_tooltip = $(this).attr("data-tooltip");

				$("#tooltip").text($data_tooltip)
                     .css({
                         "top" : eventObject.pageY + 5,
                        "left" : eventObject.pageX + 5
                     })
                     .show();

			}).mouseout(function () {

				$("#tooltip").hide()
                     .text("")
                     .css({
                         "top" : 0,
                        "left" : 0
                     });
				});
			});// Ready end
		</script>
</div>
<div id="tooltip"></div>

<div id="foot">Нижний Новгород, 2016г.</div>

</body>
</html>
