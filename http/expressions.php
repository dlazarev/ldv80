<!DOCTYPE html>
<?php
	include "/home/dmitry/ldv80.perets.su/http/scripts/lastTempData.php";
?>

<html>
	<head>
		<link rel="stylesheet/less" type="text/css" href="css/m_style.less">
		<link rel="icon" type="image/png" href="img/SmartHouse-favicon.png"/>
		<script src="scripts/jquery-3.0.0.min.js"></script>
		<script src="scripts/less.min.js"></script>
		<script src="scripts/expressions.js"></script>
		<script>
			var val_php = '<?=$ret_val;?>';
		</script>
		<title>Редактирование параметров датчика</title>
	</head>
<body>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/header.php"
?>
<?php
include "/home/dmitry/ldv80.perets.su/http/scripts/mainmenu.php"
?>

<div id="content">
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

	<h1>Настройка управляющих элементов</h1>

	<form class="expression" action="expressionsUpdate.php" method="post">
		<fieldset class="row1">

			<legend>Управляющий элемент</legend>
			<p>
				<select name="control">
					<option value="R1">Реле №1</option>
					<option value="R2">Реле №2</option>
					<option value="R3">Реле №3</option>
					<option value="R4">Реле №4</option>
				</select>
				<input type="radio" name="action" value="On"/>On
				<input type="radio" name="action" value="Off"/>Off
			</p>
			<div class="clear"></div>

		</fieldset>

		<fieldset class="row2">

			<legend>Выбор порогов температурных датчиков</legend>
			<input type="button" value="Добавить строку" onClick="addRow('dataTable')"/>
			<input type="button" value="Удалить строку" onClick="removeRow('dataTable')"/>
			<table id="dataTable" class="form" border="1">
				<tbody>
					<tr>
						<p>
							<td>
								<label>Датчик</label>
								<select id="selectSensor" name="sensor[]" data-tooltip="" onchange="sensorOnChange(val_php)">
									<option value="">----</option>
								<?php
									foreach($new_arr as $row)
										print('<option value="'.$row['address'].'">'.$row['name'].'</option>'."\n");
								?>
								</select>
							</td>

							<td>
								<label>Вид сравнения</label>
								<select name="compare_type[]">
									<option value="<">&lt</option>
									<option value=">">&gt</option>
									<option value="=">=</option>
								</select>
							</td>

							<td>
								<label>Пороговое значение температуры:</label>
								<input type="number" name="value[]" size="3" min="-40" max="40">
							</td>
						</p>
					</tr>
				</tbody>
			</table>
		<div class="clear"></div>

		</fieldset>
		<input class="submit" type="submit" value="Сохранить"/>
	</form>

</div>

<div id="tooltip"></div>

<div id="foot">Нижний Новгород, 2016г.</div>

</body>
</html>
