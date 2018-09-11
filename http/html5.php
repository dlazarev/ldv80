<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/lastTempData.php";
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Изучаю html5</title>
		<script src="scripts/jquery-3.0.0.min.js"></script>
		<script src="scripts/sensorRect.js"></script>
		<script>
		var canvas, w, h, ctx;
		var val_php = '<?=$ret_val;?>';

		$(document).ready(function() {
			var arr = JSON.parse(val_php);
//			alert(arr[1][2]);
			canvas = document.getElementById("canvas");
			ctx = canvas.getContext("2d");
			for (var i=0; i < arr.length; i++) {
//				ctx.fillText(arr[i][2],5,200+i*20);
				drawRect(canvas, arr[i], i);
			};
			w = canvas.width;
			h = canvas.height;
//			ctx.fillText(arr[0][1],5,250);
//			ctx.fillText(arr[0][2],5,300);
//			drawRect(canvas);

		});

		</script>
	</head>
	<body>
		<div>

			<canvas id="canvas" width="400" height="800" onmousemove="move(event)" style="border:1px solid #000000;"></canvas>
		</div>
<p>Тестовый сенсор</p>
<script>
	tempUp();
</script>
	</body>
</html>
