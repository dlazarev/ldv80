function displayFloors(arr) {
	var firstFloorImageObj = new Image();
	var secondFloorImageObj = new Image();

	firstFloorImageObj.onload = function() {
		var canvas = document.getElementById("firstFloor");
        canvas.getContext('2d').drawImage(firstFloorImageObj, 0, 0, canvas.width, canvas.height);
		drawFloor(1,canvas , arr);
      };

	secondFloorImageObj.onload = function() {
		var canvas = document.getElementById("secondFloor");
        canvas.getContext('2d').drawImage(secondFloorImageObj, 0, 0, canvas.width, canvas.height);
		drawFloor(2, canvas, arr);
      };

    firstFloorImageObj.src = "img/firstFloor.png";
    secondFloorImageObj.src = "img/secondFloor.png";
}

function drawFloor(nFloor, canvas, arr) {
	var ctx = canvas.getContext("2d");
	var w = canvas.width;
	var h = canvas.height;

	ctx.fillStyle = 'blue';
    ctx.font = 'italic 24pt Calibri';
    ctx.fillText(nFloor + " этаж", 68, 380);

	ctx.fillStyle = 'black';
    ctx.font = 'italic 8pt Calibri';

	arr.forEach(function(item, i, arr) {
		if (item.floor === nFloor) {
			drawTempGradient(ctx, item);
			ctx.fillText(item.name, item.x_coord, item.y_coord);
			ctx.fillText(item.value + "\xB0C", item.x_coord, item.y_coord + 20);
		}
	});
}

function drawTempGradient(ctx, item) {
	var gradientTable = [{color:"#0000AE", temp:16},
						 {color:"#0011FD", temp:18},
						 {color:"#0081FB", temp:19},
						 {color:"#00E0FE", temp:20},
						 {color:"#41FBBA", temp:21},
						 {color:"#A2FB65", temp:22},
						 {color:"#FFFC00", temp:23},
						 {color:"#FAA004", temp:24},
						 {color:"#FF4202", temp:26},
						 {color:"#DF0001", temp:30}];
	
	var color = gradientTable[9].color;
	
	for (var i = 0; i < 10; i++) {
		if (item.value < gradientTable[i].temp) {
			color = gradientTable[i].color;
			break;
		}
	}					 
	
	ctx.beginPath();
	var oldStyle = ctx.fillStyle;
	ctx.fillStyle = color;
	ctx.fillRect(item.x_coord, item.y_coord, 40, 40);
	ctx.fillStyle = oldStyle;
	ctx.closePath();
	
}
