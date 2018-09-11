function sensorOnChange(data_array) {
	var elem = document.getElementById("selectSensor");
	var address = document.getElementById("selectSensor").value;

	var arr = JSON.parse(data_array);

	for (var i = 0; i < arr.length; i++) {
		if (arr[i].address === address) {
			elem.dataset.tooltip = "Текущая температура " + arr[i].value + " \xB0C";
		}
	}
}

function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount < 5){							// limit the user from creating fields more than your limits
		var row = table.insertRow(rowCount);
		var colCount = table.rows[0].cells.length;
		for(var i=0; i<colCount; i++) {
			var newcell = row.insertCell(i);
			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
		}
	}else{
		 alert("Максимальное число условий 5.");

	}
}

function removeRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	if(rowCount > 1) { 						// limit the user from removing all the fields
		table.deleteRow(rowCount - 1);
	}
	else {
		alert("Должна быть хотя бы одна строка условия.");
	}
}
